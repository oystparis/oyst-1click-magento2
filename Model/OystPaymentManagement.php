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
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
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
            $scopeConfig
        );
    }

    /**
     * TODO : Check if order has already been captured
     * @param array $orderIds
     * @param bool $skipInvoiceCreation
     * @return $this
     */
    public function handleMagentoOrdersToCapture(array $orderIds, $skipInvoiceCreation = false)
    {
        $orders = $this->orderCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => $orderIds])
            ->addFieldToFilter('status', \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_TO_CAPTURE);

        if (count($orders) == 0) {
            return $this;
        }

        $oystOrderIds = [];
        foreach ($orders as $order) {
            $oystOrderIds[] = $order->getOystId();
        }

        $gatewayResult = json_decode($this->gatewayCallbackClient->callGatewayCallbackApi(
            \Oyst\OneClick\Helper\Constants::OYST_GATEWAY_ENDPOINT_TYPE_CAPTURE, $oystOrderIds
        ), true);

        if ($skipInvoiceCreation) {
            return $this;
        }

        foreach ($gatewayResult['orders'] as $gatewayOrder) {
            $order = $orders->getItemByColumnValue(
                'increment_id', $gatewayOrder['order']['merchant_order_reference']
            );

            $oystOrder = $this->oystOrderFactory->create();
            $mappedGatewayOrder = [
                'payment' => [
                    'last_transaction' => [
                        'id' => $gatewayOrder['order']['transaction']['id'],
                        'amount' => $order->getGrandTotal(),
                        'currency' => $order->getOrderCurrencyCode(),
                    ]
                ],
            ];
            $this->dataObjectHelper->populateWithArray(
                $oystOrder, $mappedGatewayOrder, '\Oyst\OneClick\Api\Data\OystOrderInterface'
            );

            $this->handleMagentoOrderPaymentCaptured($order, $oystOrder);
            $order->save();
        }

        return $this;
    }

    /**
     * TODO : Full Refund is handled but allow partial refunds
     * @param array $orderIds
     * @param bool $skipCreditmemoCreation
     * @return $this
     */
    public function handleMagentoOrdersToRefund($orderIds, $skipCreditmemoCreation = false)
    {
        $orders = $this->orderCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['in' => $orderIds]);

        if (count($orders) == 0) {
            return $this;
        }

        $oystOrderIds = [];
        foreach ($orders as $order) {
            $oystOrderIds[] = $order->getOystId();
        }

        $gatewayResult = json_decode($this->gatewayCallbackClient->callGatewayCallbackApi(
            \Oyst\OneClick\Helper\Constants::OYST_GATEWAY_ENDPOINT_TYPE_REFUND, $oystOrderIds
        ), true);

        if ($skipCreditmemoCreation) {
            return $this;
        }

        foreach ($gatewayResult['orders'] as $gatewayOrder) {
            $order = $orders->getItemByColumnValue(
                'increment_id', $gatewayOrder['order']['merchant_order_reference']
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