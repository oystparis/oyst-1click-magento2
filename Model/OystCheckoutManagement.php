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
        \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->cartTotalRepository = $cartTotalRepository;
        $this->shippingMethodManagement = $shippingMethodManagement;
        $this->oystCheckoutBuilder = $oystCheckoutBuilder;
        $this->magentoQuoteSynchronizer = $magentoQuoteSynchronizer;
        parent::__construct($customerRepository, $customerDataFactory, $quoteCollectionFactory);
    }

    public function getOystCheckoutFromMagentoQuote($id)
    {
        $quote = $this->quoteRepository->getActive($id);
        $totals = $this->cartTotalRepository->get($id);
        $shippingMethods = $quote->getShippingAddress()->getCountryId() ? $this->shippingMethodManagement->getList($id) : [];

        return $this->oystCheckoutBuilder->buildOystCheckout($quote, $totals, $shippingMethods);
    }

    public function syncMagentoQuoteWithOystCheckout($oystId, \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout)
    {
        /* @var Magento\Quote\Model\Quote $quote */
        $quote = $this->quoteRepository->getActive($oystCheckout->getInternalId());
        /* @var Magento\Customer\Model\Customer $customer */
        $customer = $this->getMagentoCustomer($oystCheckout->getUser()->getEmail());
        $this->magentoQuoteSynchronizer->syncMagentoQuote($quote, $customer,$oystCheckout);

        $this->resolveSetShippingMethodStrategy($quote, $oystCheckout->getShipping());
        $this->resolveCustomerCreationStrategy($customer, $oystCheckout->getUser());

        $quote->setTotalsCollectedFlag(false)->collectTotals();
        $this->quoteRepository->save($quote);

        return $this->getOystCheckoutFromMagentoQuote($quote->getId());
    }

    /**
     * Business logic : if shipping method requested by Oyst OneClick is available after all quote recalculations,
     * then set it else use the cheapeast shipping method available.
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Oyst\OneClick\Api\Data\Common\ShippingInterface $oystCheckoutShipping
     * @return $this
     */
    protected function resolveSetShippingMethodStrategy(
        \Magento\Quote\Model\Quote $quote,
        \Oyst\OneClick\Api\Data\Common\ShippingInterface $oystCheckoutShipping
    )
    {
        $quote->setTotalsCollectedFlag(false)->collectTotals();
        $quote->getShippingAddress()->setCollectShippingRates(true);

        $methodsAvailable = $this->shippingMethodManagement->getList($quote->getId());

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
            $cheapestShippingMethodAvailable = [];
            foreach ($methodsAvailable as $methodAvailable) {
                if (empty($cheapestShippingMethodAvailable)
                 || $methodAvailable->getAmount() < $cheapestShippingMethodAvailable['amount']) {
                    $cheapestShippingMethodAvailable = [
                        'amount' => $methodAvailable->getAmount(),
                        'code' => $methodAvailable->getCarrierCode() . '_' . $methodAvailable->getMethodCode(),
                    ];
                }
            }
            $shippingMethod = $cheapestShippingMethodAvailable['code'];
        }

        $quote->getShippingAddress()->setShippingMethod($shippingMethod);
        return $this;
    }

    /**
     * Business logic : if customer sent by Oyst OneClick does not exist,
     * then check if we have to create it.
     * @param \Magento\Customer\Api\Data\CustomerInterface $customer
     * @param \Oyst\OneClick\Api\Data\Common\UserInterface $oystCheckoutUser
     * @return boolean
     */
    protected function resolveCustomerCreationStrategy(
        \Magento\Customer\Api\Data\CustomerInterface $customer,
        \Oyst\OneClick\Api\Data\Common\UserInterface $oystCheckoutUser
    )
    {
        // TODO
        return true;
    }
}
