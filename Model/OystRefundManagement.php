<?php

namespace Oyst\OneClick\Model;

class OystRefundManagement extends AbstractOystManagement implements \Oyst\OneClick\Api\OystRefundManagementInterface
{
    protected $oystPaymentManagement;

    public function __construct(
        \Oyst\OneClick\Model\OystPaymentManagement $oystPaymentManagement,
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
        \Magento\Newsletter\Model\SubscriberFactory $newsletterSubscriberFactory,
        \Oyst\OneClick\Helper\Data $helperData
    )
    {
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
    
    public function createMagentoCreditmemo($oystId, \Oyst\OneClick\Api\Data\OystRefundInterface $oystRefund)
    {
        try {
            $order = $this->getMagentoOrderByOystId($oystId);

            $this->oystPaymentManagement->handleMagentoOrdersToRefund([$order->getId()]);

            return true;
        } catch (\Exception $e) {
            $this->helperData->handleExceptionForWebapi($e);
        }
    }
}