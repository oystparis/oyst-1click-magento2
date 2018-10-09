<?php

namespace Oyst\OneClick\Model;

class OystOrderManagement extends AbstractOystManagement implements \Oyst\OneClick\Api\OystOrderManagementInterface
{
    protected $cartManagement;

    protected $oystOrderBuilder;

    protected $orderCollectionFactory;

    protected $orderManagement;

    protected $creditmemoManagement;

    protected $creditmemoFactory;

    protected $gatewayCallbackClient;

    protected $dataObjectHelper;

    protected $oystOrderFactory;

    public function __construct(
        \Magento\Quote\Api\CartManagementInterface $cartManagement,
        \Oyst\OneClick\Model\OystOrder\Builder $oystOrderBuilder,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Oyst\OneClick\Gateway\CallbackClient $gatewayCallbackClient,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Oyst\OneClick\Api\Data\OystOrderInterfaceFactory $oystOrderFactory,
        \Magento\Sales\Api\OrderManagementInterface $orderManagement,
        \Magento\Sales\Api\CreditmemoManagementInterface $creditmemoManagement,
        \Magento\Sales\Model\Order\CreditmemoFactory $creditmemoFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerDataFactory,
        \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\SalesRule\Model\CouponFactory $couponFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Catalog\Helper\ImageFactory $imageFactory,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->cartManagement = $cartManagement;
        $this->orderManagement = $orderManagement;
        $this->creditmemoManagement = $creditmemoManagement;
        $this->creditmemoFactory = $creditmemoFactory;
        $this->oystOrderBuilder = $oystOrderBuilder;
        $this->gatewayCallbackClient = $gatewayCallbackClient;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->oystOrderFactory = $oystOrderFactory;
        parent::__construct(
            $customerRepository,
            $customerDataFactory,
            $quoteCollectionFactory,
            $productCollectionFactory,
            $couponFactory,
            $coreRegistry,
            $imageFactory,
            $appEmulation,
            $eventManager,
            $scopeConfig
        );
    }

    public function createMagentoOrderFromOystCheckout(\Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder)
    {
        $quote = $this->getMagentoQuoteByOystId($oystOrder->getOystId());

        if (!$quote->getId()) {
            throw new \Exception('Quote is not available.');
        }

        $this->cartManagement->placeOrder($quote->getId());

        return $this->getOystOrderFromMagentoOrder($oystOrder->getOystId());
    }

    public function getMagentoOrderByOystId($oystId)
    {
        return $this->orderCollectionFactory->create()
            ->addFieldToFilter('oyst_id', $oystId)
            ->setOrder('entity_id', \Magento\Framework\Data\Collection::SORT_ORDER_DESC)
            ->getFirstItem();
    }

    public function getMagentoOrderByQuoteId($quoteId)
    {
        return $this->orderCollectionFactory->create()
            ->addFieldToFilter('quote_id', $quoteId)
            ->setOrder('entity_id', \Magento\Framework\Data\Collection::SORT_ORDER_DESC)
            ->getFirstItem();
    }

    public function getOystOrderFromMagentoOrder($oystId)
    {
        $order = $this->getMagentoOrderByOystId($oystId);

        if (!$order->getId()
         || $order->getPayment()->getMethod() != \Oyst\OneClick\Model\Payment\Method\OneClick::PAYMENT_METHOD_OYST_ONECLICK_CODE) {
            throw new \Exception('Order is not available.');
        }

        return $this->oystOrderBuilder->buildOystOrder($order);
    }

    public function syncMagentoOrderWithOystOrderStatus($oystId, \Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder)
    {
        $order = $this->getMagentoOrderByOystId($oystId);

        if (!$order->getId()
         || $order->getPayment()->getMethod() != \Oyst\OneClick\Model\Payment\Method\OneClick::PAYMENT_METHOD_OYST_ONECLICK_CODE) {
            throw new \Exception('Order is not available.');
        }

        if ($oystOrder->getStatus()->getCode() == \Oyst\OneClick\Helper\Constants::OYST_API_ORDER_STATUS_CANCELED) {
            $cancelResult = $this->orderManagement->cancel($order->getId());

            if (!$cancelResult) {
                // TODO
            }
        } elseif ($oystOrder->getStatus()->getCode() == \Oyst\OneClick\Helper\Constants::OYST_API_ORDER_STATUS_PAYMENT_CAPTURED) {
            $this->handleMagentoOrderPaymentCaptured($order, $oystOrder);
            $order->save();
            // TODO send invoice email
        } elseif ($oystOrder->getStatus()->getCode() == \Oyst\OneClick\Helper\Constants::OYST_API_ORDER_STATUS_PAYMENT_WAITING_TO_CAPTURE) {
            $this->orderManagement->setState(
                $order, \Magento\Sales\Model\Order::STATE_PROCESSING, \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_WAITING_TO_CAPTURE, '', null, false
            );

            $order->save();
        } else {
            throw new \Exception('Non handled status : '.$oystOrder->getStatus()->getCode());
        }

        return $this->oystOrderBuilder->buildOystOrder($order);
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

    /**
     * TODO : Check if order has already been captured
     * @param array $orderIds
     * @param type $skipInvoiceCreation
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
     * * TODO : Allow partial refunds
     * @param type $orderIds
     * @param type $skipCreditmemoCreation
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
}