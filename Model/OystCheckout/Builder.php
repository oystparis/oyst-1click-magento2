<?php

namespace Oyst\OneClick\Model\OystCheckout;

class Builder
{
    protected $oystCheckoutFactory;

    protected $oystCheckoutUserFactory;

    protected $oystCheckoutItemFactory;

    protected $oystCheckoutCountryFactory;

    protected $oystCheckoutItemPriceFactory;

    protected $oystCheckoutTotalsFactory;

    protected $oystCheckoutTotalDetailsFactory;

    protected $oystCheckoutAddressFactory;

    protected $oystCheckoutBillingFactory;

    protected $oystCheckoutShippingFactory;

    protected $oystCheckoutShippingMethodFactory;

    protected $constantsMapper;

    protected $eventManager;

    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Oyst\OneClick\Model\ConstantsMapper $constantsMapper,
        \Oyst\OneClick\Api\Data\OystCheckoutInterfaceFactory $oystCheckoutFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\UserInterfaceFactory $oystCheckoutUserFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\ItemInterfaceFactory $oystCheckoutItemFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\CountryInterfaceFactory $oystCheckoutCountryFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\ItemPriceInterfaceFactory $oystCheckoutItemPriceFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterfaceFactory $oystCheckoutTotalsFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\TotalDetailsInterfaceFactory $oystCheckoutTotalDetailsFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\AddressInterfaceFactory $oystCheckoutAddressFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\BillingInterfaceFactory $oystCheckoutBillingFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterfaceFactory $oystCheckoutShippingFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\ShippingMethodInterfaceFactory $oystCheckoutShippingMethodFactory
    )
    {
        $this->eventManager = $eventManager;
        $this->constantsMapper = $constantsMapper;
        $this->oystCheckoutFactory = $oystCheckoutFactory;
        $this->oystCheckoutUserFactory = $oystCheckoutUserFactory;
        $this->oystCheckoutItemFactory = $oystCheckoutItemFactory;
        $this->oystCheckoutItemPriceFactory = $oystCheckoutItemPriceFactory;
        $this->oystCheckoutTotalsFactory = $oystCheckoutTotalsFactory;
        $this->oystCheckoutTotalDetailsFactory = $oystCheckoutTotalDetailsFactory;
        $this->oystCheckoutAddressFactory = $oystCheckoutAddressFactory;
        $this->oystCheckoutBillingFactory = $oystCheckoutBillingFactory;
        $this->oystCheckoutShippingFactory = $oystCheckoutShippingFactory;
        $this->oystCheckoutShippingMethodFactory = $oystCheckoutShippingMethodFactory;
        $this->oystCheckoutCountryFactory = $oystCheckoutCountryFactory;
    }

    public function buildOystCheckout(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\TotalsInterface $totals,
        array $shippingMethods
    )
    {
        /* @var $oystCheckout \Oyst\OneClick\Api\Data\OystCheckoutInterface */
        $oystCheckout = $this->oystCheckoutFactory->create();

        $oystCheckout->setOystId($quote->getOystId());
        $oystCheckout->setInternalId($quote->getId());
        $oystCheckout->setIp($quote->getRemoteIp());
        $oystCheckout->setCurrency($quote->getCurrency()->getQuoteCurrencyCode());

        $oystCheckout->setUser($this->buildOystCheckoutUser($quote));
        $oystCheckout->setTotals($this->buildOystCheckoutTotals($totals));
        $oystCheckout->setBilling($this->buildOystCheckoutBilling($quote));
        $oystCheckout->setShipping($this->buildOystCheckoutShipping($quote, $shippingMethods));
        $oystCheckout->setItems($this->buildOystCheckoutItems($quote));

        return $oystCheckout;
    }

    protected function buildOystCheckoutUser(
        \Magento\Quote\Model\Quote $quote
    )
    {
        /* @var $oystCheckoutUser \Oyst\OneClick\Api\Data\OystCheckout\UserInterface */
        $oystCheckoutUser = $this->oystCheckoutUserFactory->create();

        $customer = $quote->getCustomer();

        if ($customer->getId()) {
            $oystCheckoutUser->setEmail($customer->getEmail());
            $oystCheckoutUser->setFirstname($customer->getFirstname());
            $oystCheckoutUser->setLastname($customer->getLastname());
        } else {
            $oystCheckoutUser->setEmail($quote->getCustomerEmail());
            $oystCheckoutUser->setFirstname($quote->getCustomerFirstname());
            $oystCheckoutUser->setLastname($quote->getCustomerLastname());
        }

        return $oystCheckoutUser;
    }

    protected function buildOystCheckoutTotals(
        \Magento\Quote\Api\Data\TotalsInterface $totals
    )
    {
        /* @var $oystCheckoutTotals \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterface */
        $oystCheckoutTotals = $this->oystCheckoutTotalsFactory->create();

        $oystCheckoutTotals->setDetailsTaxIncl($this->buildOystCheckoutTotalDetailsTaxIncl($totals));
        $oystCheckoutTotals->setDetailsTaxExcl($this->buildOystCheckoutTotalDetailsTaxExcl($totals));

        return $oystCheckoutTotals;
    }

    protected function buildOystCheckoutTotalDetailsTaxIncl(
        \Magento\Quote\Api\Data\TotalsInterface $totals
    )
    {
        /* @var $oystCheckoutTotalDetails \Oyst\OneClick\Api\Data\OystCheckout\TotalDetailsInterface */
        $oystCheckoutTotalDetails = $this->oystCheckoutTotalDetailsFactory->create();

        $oystCheckoutTotalDetails->setTotal($totals->getGrandTotal());
        $oystCheckoutTotalDetails->setTotalDiscount($totals->getDiscountAmount());
        $oystCheckoutTotalDetails->setTotalItems($totals->getSubtotalInclTax());
        $oystCheckoutTotalDetails->setTotalShipping($totals->getShippingInclTax());

        return $oystCheckoutTotalDetails;
    }

    protected function buildOystCheckoutTotalDetailsTaxExcl(
        \Magento\Quote\Api\Data\TotalsInterface $totals
    )
    {
        /* @var $oystCheckoutTotalDetails \Oyst\OneClick\Api\Data\OystCheckout\TotalDetailsInterface */
        $oystCheckoutTotalDetails = $this->oystCheckoutTotalDetailsFactory->create();

        $oystCheckoutTotalDetails->setTotal($totals->getGrandTotal() - $totals->getTaxAmount());
        /*$oystCheckoutTotalDetails->setTotalDiscount($totals->getDiscountAmount());
        $oystCheckoutTotalDetails->setTotalItems($totals->getSubtotalInclTax());
        $oystCheckoutTotalDetails->setTotalShipping($totals->getShippingInclTax());*/

        return $oystCheckoutTotalDetails;
    }

    protected function buildOystCheckoutItems(
        \Magento\Quote\Model\Quote $quote
    )
    {
        $oystCheckoutItems = [];

        foreach ($quote->getAllItems() as $item) {
            /* @var $item \Magento\Quote\Model\Quote\Item */
            $product = $item->getProduct();
            /* @var $oystCheckoutItem \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface */
            $oystCheckoutItem = $this->oystCheckoutItemFactory->create();

            $oystCheckoutItem->setName($item->getName());
            $oystCheckoutItem->setType($this->constantsMapper->mapMagentoProductTypeToOystCheckoutItemType($item->getProductType()));
            $oystCheckoutItem->setDescriptionShort($product->getShortDescription());
            $oystCheckoutItem->setReference($item->getSku());
            $oystCheckoutItem->setInternalReference($item->getId());
            $oystCheckoutItem->setImage($product->getImage());
            $oystCheckoutItem->setWeight($product->getWeight());
            $oystCheckoutItem->setQuantity($item->getQty());
            $oystCheckoutItem->setPrice($this->buildOystCheckoutItemPrice($item));

            $oystCheckoutItems[] = $oystCheckoutItem;
        }

        return $oystCheckoutItems;
    }

    protected function buildOystCheckoutItemPrice(
        \Magento\Quote\Model\Quote\Item $item
    )
    {
        /* @var $oystCheckoutItemPrice \Oyst\OneClick\Api\Data\OystCheckout\ItemPriceInterface */
        $oystCheckoutItemPrice = $this->oystCheckoutItemPriceFactory->create();

        $oystCheckoutItemPrice->setTaxIncl($item->getPriceInclTax());
        $oystCheckoutItemPrice->setTaxExcl($item->getPrice());
        $oystCheckoutItemPrice->setTotalTaxIncl($item->getRowTotalInclTax());
        $oystCheckoutItemPrice->setTotalTaxExcl($item->getRowTotal());
        //$oystCheckoutItemPrice->setWithoutDiscountTaxIncl($item->getDiscountAmount());
        //$oystCheckoutItemPrice->setWithoutDiscountTaxExcl($withoutDiscountTaxExcl);

        return $oystCheckoutItemPrice;
    }

    protected function buildOystCheckoutAddress(
        \Magento\Quote\Model\Quote\Address $address
    )
    {
        /* @var $oystCheckoutAddress \Oyst\OneClick\Api\Data\OystCheckout\AddressInterface */
        $oystCheckoutAddress = $this->oystCheckoutAddressFactory->create();

        $oystCheckoutAddress->setFirstname($address->getFirstname());
        $oystCheckoutAddress->setLastname($address->getLastname());
        $oystCheckoutAddress->setEmail($address->getEmail());
        $oystCheckoutAddress->setCity($address->getCity());
        $oystCheckoutAddress->setPostcode($address->getPostcode());
        $oystCheckoutAddress->setCountry($this->buildOystCheckoutCountry($address->getCountryModel()->getCountryId(), $address->getCountryModel()->getName()));
        $oystCheckoutAddress->setStreet1($address->getStreetLine(1));
        $oystCheckoutAddress->setStreet2($address->getStreetLine(2));

        return $oystCheckoutAddress;
    }

    protected function buildOystCheckoutCountry($code, $label)
    {
        /* @var $oystCheckoutCountry \Oyst\OneClick\Api\Data\OystCheckout\CountryInterface */
        $oystCheckoutCountry = $this->oystCheckoutCountryFactory->create();

        $oystCheckoutCountry->setCode($code);
        $oystCheckoutCountry->setLabel($label);

        return $oystCheckoutCountry;
    }

    protected function buildOystCheckoutBilling(
        \Magento\Quote\Model\Quote $quote
    )
    {
        /* @var $oystCheckoutBilling \Oyst\OneClick\Api\Data\OystCheckout\BillingInterface */
        $oystCheckoutBilling = $this->oystCheckoutBillingFactory->create();

        $oystCheckoutBilling->setAddress($this->buildOystCheckoutAddress($quote->getBillingAddress()));

        return $oystCheckoutBilling;
    }

    protected function buildOystCheckoutShipping(
        \Magento\Quote\Model\Quote $quote,
        array $shippingMethods
    )
    {
        /* @var $oystCheckoutShipping \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface */
        $oystCheckoutShipping = $this->oystCheckoutShippingFactory->create();

        $oystCheckoutShipping->setAddress($this->buildOystCheckoutAddress($quote->getShippingAddress()));
        $oystCheckoutShipping->setMethodsAvailable($this->buildOystCheckoutShippingMethodsAvailable($shippingMethods));
        $oystCheckoutShipping->setMethodApplied($this->buildOystCheckoutShippingMethodApplied($quote, $shippingMethods));

        return $oystCheckoutShipping;
    }

    protected function buildOystCheckoutShippingMethodsAvailable(
        array $shippingMethods
    )
    {
        $oystCheckoutShippingMethods = [];

        foreach ($shippingMethods as $shippingMethod) {
            /* @var $shippingMethod \Magento\Quote\Api\Data\ShippingMethodInterface */
            /* @var $oystCheckoutShippingMethod \Oyst\OneClick\Api\Data\OystCheckout\ShippingMethodInterface */
            $oystCheckoutShippingMethod = $this->oystCheckoutShippingMethodFactory->create();

            $oystCheckoutShippingMethod->setAmountTaxExcl($shippingMethod->getPriceExclTax());
            $oystCheckoutShippingMethod->setAmountTaxIncl($shippingMethod->getPriceInclTax());
            $oystCheckoutShippingMethod->setLabel($shippingMethod->getMethodTitle());
            $oystCheckoutShippingMethod->setReference($shippingMethod->getCarrierCode() . '_' . $shippingMethod->getMethodCode());

            $oystCheckoutShippingMethods[] = $oystCheckoutShippingMethod;
        }

        return $oystCheckoutShippingMethods;
    }

    protected function buildOystCheckoutShippingMethodApplied(
        \Magento\Quote\Model\Quote $quote,
        array $shippingMethods
    )
    {
        $shippingMethod = $quote->getShippingAddress()->getShippingMethod();

        foreach ($this->buildOystCheckoutShippingMethodsAvailable($shippingMethods) as $oystCheckoutShippingMethod) {
            if ($oystCheckoutShippingMethod->getReference() == $shippingMethod) {
                return $oystCheckoutShippingMethod;
            }
        }

        return null;
    }
}
