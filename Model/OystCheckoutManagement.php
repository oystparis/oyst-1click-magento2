<?php

namespace Oyst\OneClick\Model;

class OystCheckoutManagement implements \Oyst\OneClick\Api\OystCheckoutManagementInterface
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

    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\Quote\Api\CartTotalRepositoryInterface $cartTotalRepository,
        \Magento\Quote\Api\ShippingMethodManagementInterface $shippingMethodManagement,
        \Oyst\OneClick\Model\OystCheckout\Builder $oystCheckoutBuilder
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->cartTotalRepository = $cartTotalRepository;
        $this->shippingMethodManagement = $shippingMethodManagement;
        $this->oystCheckoutBuilder = $oystCheckoutBuilder;
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

    }
}
