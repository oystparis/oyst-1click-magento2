<?php

namespace Oyst\OneClick\Model;

class OystOrderManagement extends AbstractOystManagement implements \Oyst\OneClick\Api\OystOrderManagementInterface
{
    protected $cartManagement;

    protected $oystOrderBuilder;

    protected $orderManagement;

    protected $oystPaymentManagement;

    public function __construct(
        \Oyst\OneClick\Model\OystPaymentManagement $oystPaymentManagement,
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
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Newsletter\Model\SubscriberFactory $newsletterSubscriberFactory,
        \Oyst\OneClick\Helper\Data $helperData
    )
    {
        $this->cartManagement = $cartManagement;
        $this->orderManagement = $orderManagement;
        $this->oystOrderBuilder = $oystOrderBuilder;
        $this->oystPaymentManagement = $oystPaymentManagement;
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
            $newsletterSubscriberFactory,
            $helperData
        );
    }

    public function createMagentoOrderFromOystOrder(\Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder)
    {
        try {
            $quote = $this->getMagentoQuoteByOystId($oystOrder->getOystId());

            if (!$quote->getId()) {
                throw new \Exception('Quote is not available.');
            }

            $this->helperData->addQuoteExtraData(
                $quote, 'newsletter_optin', $oystOrder->getUser()->getNewsletter()
            );
            $quote->save();

            $this->cartManagement->placeOrder($quote->getId());

            return $this->getOystOrderFromMagentoOrder($oystOrder->getOystId());
        } catch (\Exception $e) {
            $this->helperData->handleExceptionForWebapi($e);
        }
    }

    public function getOystOrderFromMagentoOrder($oystId)
    {
        try {
            $order = $this->getMagentoOrderByOystId($oystId);

            if (!$order->getId()
             || $order->getPayment()->getMethod() != \Oyst\OneClick\Model\Payment\Method\OneClick::PAYMENT_METHOD_OYST_ONECLICK_CODE) {
                throw new \Exception('Order is not available.');
            }

            return $this->oystOrderBuilder->buildOystOrder($order);
        } catch (\Exception $e) {
            $this->helperData->handleExceptionForWebapi($e);
        }
    }

    public function syncMagentoOrderWithOystOrderStatus($oystId, \Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder)
    {
        try {
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
        } catch (\Exception $e) {
            $this->helperData->handleExceptionForWebapi($e);
        }
    }
}