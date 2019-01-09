<?php

namespace Oyst\OneClick\Model;

class OystCheckoutManagement extends AbstractOystManagement implements \Oyst\OneClick\Api\OystCheckoutManagementInterface
{
    /**
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var \Magento\Quote\Api\CartTotalRepositoryInterface
     */
    protected $cartTotalRepository;

    /**
     * @var \Magento\Quote\Api\ShippingMethodManagementInterface
     */
    protected $shippingMethodManagement;

    /**
     * @var \Oyst\OneClick\Model\OystCheckout\Builder
     */
    protected $oystCheckoutBuilder;

    /**
     * @var \Oyst\OneClick\Model\MagentoQuote\Synchronizer
     */
    protected $magentoQuoteSynchronizer;

    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\Quote\Api\CartTotalRepositoryInterface $cartTotalRepository,
        \Magento\Quote\Api\ShippingMethodManagementInterface $shippingMethodManagement,
        \Oyst\OneClick\Model\OystCheckout\Builder $oystCheckoutBuilder,
        \Oyst\OneClick\Model\MagentoQuote\Synchronizer $magentoQuoteSynchronizer,
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
        $this->quoteRepository = $quoteRepository;
        $this->cartTotalRepository = $cartTotalRepository;
        $this->shippingMethodManagement = $shippingMethodManagement;
        $this->oystCheckoutBuilder = $oystCheckoutBuilder;
        $this->magentoQuoteSynchronizer = $magentoQuoteSynchronizer;
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

    public function getOystCheckoutFromMagentoQuote($id)
    {
        $quote = $this->quoteRepository->getActive($id);
        $totals = $this->cartTotalRepository->get($id);
        $shippingMethods = $this->getShippingMethodList($quote);
        $products = $this->getMagentoProductsById(
            array_map(function($item) {return $item->getProductId();}, $quote->getAllItems()),
            $quote->getStoreId()
        );
        $this->addNewsletterSubscriberToCustomer($quote->getCustomer());

        return $this->oystCheckoutBuilder->buildOystCheckout($quote, $totals, $shippingMethods, $products);
    }

    public function syncMagentoQuoteWithOystCheckout($oystId, \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout)
    {
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->quoteRepository->getActive($oystCheckout->getInternalId());
        /* @var \Magento\Customer\Api\Data\CustomerInterface $customer */
        $customer = $this->getMagentoCustomer($oystCheckout->getUser()->getEmail());
        /* @var \Magento\SalesRule\Model\Coupon $coupon */
        $coupon = $this->getMagentoCoupon($oystCheckout->getCoupons());
        $this->magentoQuoteSynchronizer->syncMagentoQuote($oystCheckout, $quote, $customer, $coupon);

        if(!$quote->isVirtual()) {
            $quote->setTotalsCollectedFlag(false)->collectTotals();
            /* @var array $methodsAvailable */
            $methodsAvailable = $this->getShippingMethodList($quote);
            $this->resolveSetShippingMethodStrategy($quote->getShippingAddress(), $methodsAvailable, $oystCheckout->getShipping());
        }

        $quote->setTotalsCollectedFlag(false)->collectTotals();
        $this->quoteRepository->save($quote);

        return $this->getOystCheckoutFromMagentoQuote($quote->getId());
    }

    /**
     * Business logic : if shipping method requested by Oyst OneClick is available after all quote recalculations,
     * then set it else use the cheapeast shipping method available.
     * @param \Magento\Quote\Model\Quote\Address $shippingAddress
     * @param array $methodsAvailable
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface $oystCheckoutShipping
     * @return $this
     */
    public function resolveSetShippingMethodStrategy(
        \Magento\Quote\Model\Quote\Address $shippingAddress,
        array $methodsAvailable,
        \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface $oystCheckoutShipping
    )
    {
        $isRequestedShippingMethodAvailable = false;
        $shippingMethod = null;
        if ($oystCheckoutShipping->getMethodApplied()) {
            foreach ($methodsAvailable as $methodAvailable) {
                $shippingMethod = $methodAvailable->getCarrierCode() . '_' . $methodAvailable->getMethodCode();
                if ($shippingMethod == $oystCheckoutShipping->getMethodApplied()->getReference()) {
                    $isRequestedShippingMethodAvailable = true;
                    break;
                }
            }
        }

        if (!$isRequestedShippingMethodAvailable) {
            $oystMethodsAvailable = [];
            foreach ($oystCheckoutShipping->getMethodsAvailable() as $oystMethodAvailable) {
                $oystMethodsAvailable[] = $oystMethodAvailable->getReference();
            }

            $cheapestShippingMethodAvailable = [];
            foreach ($methodsAvailable as $methodAvailable) {
                $tmpShippingMethod = $methodAvailable->getCarrierCode() . '_' . $methodAvailable->getMethodCode();
                if (!in_array($tmpShippingMethod, $oystMethodsAvailable)) {
                    continue;
                }

                if (empty($cheapestShippingMethodAvailable)
                 || $methodAvailable->getAmount() < $cheapestShippingMethodAvailable['amount']) {
                    $cheapestShippingMethodAvailable = [
                        'amount' => $methodAvailable->getAmount(),
                        'code' => $tmpShippingMethod,
                    ];
                }
            }
            if (isset($cheapestShippingMethodAvailable['code'])) {
                $shippingMethod = $cheapestShippingMethodAvailable['code'];
            }
        }

        $shippingAddress->setShippingMethod($shippingMethod);
        return $this;
    }

    protected function getShippingMethodList(
        \Magento\Quote\Model\Quote $quote
    )
    {
        if (!$quote->getShippingAddress()->getCountryId()) {
            return [];
        }

        $oldItems = $quote->getShippingAddress()->getData('cached_items_all');

        $items = [];
        foreach($quote->getAllItems() as $item) {
            if ($item->getData('parent_item_id')) {
                continue;
            }
            $items[] = $item;
        }
        $quote->getShippingAddress()->setData('cached_items_all', $items);
        $quote->getShippingAddress()->setCollectShippingRates(true);

        $result = $this->shippingMethodManagement->getList($quote->getId());

        $quote->getShippingAddress()->setData('cached_items_all', $oldItems);

        return $result;
    }
}
