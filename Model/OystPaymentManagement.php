<?php

namespace Oyst\OneClick\Model;

class OystPaymentManagement extends AbstractOystManagement
{
    protected $creditmemoManagement;

    protected $creditmemoFactory;

    protected $gatewayCallbackClient;

    protected $dataObjectHelper;

    protected $orderManagement;

    public function __construct(
        \Oyst\OneClick\Gateway\CallbackClient $gatewayCallbackClient,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Oyst\OneClick\Api\Data\OystOrderInterfaceFactory $oystOrderFactory,
        \Magento\Sales\Api\CreditmemoManagementInterface $creditmemoManagement,
        \Magento\Sales\Api\OrderManagementInterface $orderManagement,
        \Magento\Sales\Model\Order\CreditmemoFactory $creditmemoFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerDataFactory,
        \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\SalesRule\Model\CouponFactory $couponFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Catalog\Helper\ImageFactory $imageFactory,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Newsletter\Model\SubscriberFactory $newsletterSubscriberFactory
    )
    {
        $this->creditmemoManagement = $creditmemoManagement;
        $this->creditmemoFactory = $creditmemoFactory;
        $this->gatewayCallbackClient = $gatewayCallbackClient;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->oystOrderFactory = $oystOrderFactory;
        $this->orderManagement = $orderManagement;
        parent::__construct(
            $customerRepository,
            $customerDataFactory,
            $quoteCollectionFactory,
            $productCollectionFactory,
            $orderCollectionFactory,
            $couponFactory,
            $coreRegistry,
            $imageFactory,
            $appEmulation,
            $eventManager,
            $scopeConfig,
            $newsletterSubscriberFactory
        );
    }

    /**
     * TODO : Check if order has already been captured
     * @param array $orderAmounts (Amounts indexed by order ids)
     * @param bool $skipInvoiceCreation
     * @return $this
     */
    public function handleMagentoOrdersToCapture(array $orderAmounts, $skipInvoiceCreation = false)
    {
        $orders = $this->orderCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => array_keys($orderAmounts)])
            ->addFieldToFilter('status', \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_TO_CAPTURE);

        if (count($orders) == 0) {
            return $this;
        }

        $oystOrderAmounts = [];
        foreach ($orders as $order) {
            $oystOrderAmounts[$order->getOystId()] = $orderAmounts[$order->getId()];
        }

        $gatewayResult = json_decode($this->gatewayCallbackClient->callGatewayCallbackApi(
            \Oyst\OneClick\Helper\Constants::OYST_GATEWAY_ENDPOINT_TYPE_CAPTURE, $oystOrderAmounts
        ), true);

        if ($skipInvoiceCreation) {
            return $this;
        }

        foreach ($gatewayResult['orders'] as $gatewayOrder) {
            $order = $orders->getItemByColumnValue(
                'increment_id', $gatewayOrder['internal_id']
            );

            $oystOrder = $this->oystOrderFactory->create();

            $this->dataObjectHelper->populateWithArray(
                $oystOrder, $gatewayOrder, '\Oyst\OneClick\Api\Data\OystOrderInterface'
            );

            $this->handleMagentoOrderPaymentCaptured($order, $oystOrder);
            $order->save();
        }

        return $this;
    }

    /**
     * @param array $orderAmounts (Amounts indexed by order ids)
     * @param bool $skipCreditmemoCreation
     * @return $this
     */
    public function handleMagentoOrdersToRefund($orderAmounts, $skipCreditmemoCreation = false)
    {
        $orders = $this->orderCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => array_keys($orderAmounts)]);

        if (count($orders) == 0) {
            return $this;
        }

        $oystOrderAmounts = [];
        foreach ($orders as $order) {
            $oystOrderAmounts[$order->getOystId()] = $orderAmounts[$order->getId()];
        }

        $gatewayResult = json_decode($this->gatewayCallbackClient->callGatewayCallbackApi(
            \Oyst\OneClick\Helper\Constants::OYST_GATEWAY_ENDPOINT_TYPE_REFUND, $oystOrderAmounts
        ), true);

        if ($skipCreditmemoCreation) {
            return $this;
        }

        foreach ($gatewayResult['orders'] as $gatewayOrder) {
            $order = $orders->getItemByColumnValue(
                'increment_id', $gatewayOrder['internal_id']
            );

            $creditmemo = $this->creditmemoFactory->createByOrder($order);
            $this->creditmemoManagement->refund($creditmemo, true);
        }

        return $this;
    }

    public function handleMagentoOrderPaymentCaptured(\Magento\Sales\Model\Order $order, \Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder)
    {
        $payment = $order->getPayment();
        $payment->setTransactionId($oystOrder->getPayment()->getLastTransaction()->getId());
        $payment->setCurrencyCode($oystOrder->getPayment()->getLastTransaction()->getCurrency());
        $payment->setPreparedMessage(
            __('Oyst OneClick Payment Captured : ')
        );
        $payment->setShouldCloseParentTransaction(true);
        $payment->setIsTransactionClosed(1);

        if ($this->scopeConfig->getValue('oyst_oneclick/general/enable_invoice_auto_generation')) {
            $payment->registerCaptureNotification($oystOrder->getPayment()->getLastTransaction()->getAmount());
        }

        if ($order->getState() != \Magento\Sales\Model\Order::STATE_PAYMENT_REVIEW) {
            $this->orderManagement->setState(
                $order, \Magento\Sales\Model\Order::STATE_PROCESSING, \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_CAPTURED, '', null, false
            );
        }
    }
}