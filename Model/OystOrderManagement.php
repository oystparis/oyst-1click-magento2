<?php

namespace Oyst\OneClick\Model;

class OystOrderManagement extends AbstractOystManagement implements \Oyst\OneClick\Api\OystOrderManagementInterface
{
    protected $cartManagement;

    protected $oystOrderBuilder;

    protected $orderManagement;

    public function __construct(
        \Magento\Quote\Api\CartManagementInterface $cartManagement,
        \Oyst\OneClick\Model\OystOrder\Builder $oystOrderBuilder,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Api\OrderManagementInterface $orderManagement,
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
        $this->cartManagement = $cartManagement;
        $this->orderManagement = $orderManagement;
        $this->oystOrderBuilder = $oystOrderBuilder;
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

    public function createMagentoOrderFromOystOrder(\Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder)
    {
        $quote = $this->getMagentoQuoteByOystId($oystOrder->getOystId());

        if (!$quote->getId()) {
            throw new \Exception('Quote is not available.');
        }

        $this->cartManagement->placeOrder($quote->getId());

        return $this->getOystOrderFromMagentoOrder($oystOrder->getOystId());
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
            $this->oystPaymentManagement->handleMagentoOrderPaymentCaptured($order, $oystOrder);
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
}