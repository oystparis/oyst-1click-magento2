<?php

namespace Oyst\OneClick\Model\OystCheckout;

use Oyst\OneClick\Helper\Constants as HelperConstants;

class Builder extends \Oyst\OneClick\Model\Common\AbstractBuilder
{
    protected $oystCheckoutFactory;

    protected $oystCheckoutItemFactory;

    protected $oystCheckoutShippingFactory;

    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Oyst\OneClick\Model\ConstantsMapper $constantsMapper,
        \Oyst\OneClick\Helper\SalesRule $helperSalesRule,
        \Oyst\OneClick\Api\Data\Common\AddressInterfaceFactory $oystCommonAddressFactory,
        \Oyst\OneClick\Api\Data\Common\BillingInterfaceFactory $oystCommonBillingFactory,
        \Oyst\OneClick\Api\Data\Common\CountryInterfaceFactory $oystCommonCountryFactory,
        \Oyst\OneClick\Api\Data\Common\CouponInterfaceFactory $oystCommonCouponFactory,
        \Oyst\OneClick\Api\Data\Common\DiscountInterfaceFactory $oystCommonDiscountFactory,
        \Oyst\OneClick\Api\Data\Common\ItemAttributeInterfaceFactory $oystCommonItemAttributeInterfaceFactory,
        \Oyst\OneClick\Api\Data\Common\ItemPriceInterfaceFactory $oystCommonItemPriceFactory,
        \Oyst\OneClick\Api\Data\Common\ShippingMethodInterfaceFactory $oystCommonShippingMethodFactory,
        \Oyst\OneClick\Api\Data\Common\ShopInterfaceFactory $oystCommonShopFactory,
        \Oyst\OneClick\Api\Data\Common\TotalDetailsInterfaceFactory $oystCommonTotalDetailsFactory,
        \Oyst\OneClick\Api\Data\Common\TotalsInterfaceFactory $oystCommonTotalsFactory,
        \Oyst\OneClick\Api\Data\Common\UserInterfaceFactory $oystCommonUserFactory,
        \Oyst\OneClick\Api\Data\OystCheckoutInterfaceFactory $oystCheckoutFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\ItemInterfaceFactory $oystCheckoutItemFactory,
        \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterfaceFactory $oystCheckoutShippingFactory
    )
    {
        $this->oystCheckoutFactory = $oystCheckoutFactory;
        $this->oystCheckoutItemFactory = $oystCheckoutItemFactory;
        $this->oystCheckoutShippingFactory = $oystCheckoutShippingFactory;
        parent::__construct(
            $eventManager,
            $constantsMapper,
            $helperSalesRule,
            $oystCommonAddressFactory,
            $oystCommonBillingFactory,
            $oystCommonCountryFactory,
            $oystCommonCouponFactory,
            $oystCommonDiscountFactory,
            $oystCommonItemAttributeInterfaceFactory,
            $oystCommonItemPriceFactory,
            $oystCommonShippingMethodFactory,
            $oystCommonShopFactory,
            $oystCommonTotalDetailsFactory,
            $oystCommonTotalsFactory,
            $oystCommonUserFactory
        );
    }

    public function buildOystCheckout(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\TotalsInterface $totals,
        array $shippingMethods,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $products
    )
    {
        /* @var $oystCheckout \Oyst\OneClick\Api\Data\OystCheckoutInterface */
        $oystCheckout = $this->oystCheckoutFactory->create();

        $oystCheckout->setOystId($quote->getOystId());
        $oystCheckout->setInternalId($quote->getId());
        $oystCheckout->setIp($quote->getRemoteIp());
        $oystCheckout->setCurrency($quote->getCurrency()->getQuoteCurrencyCode());

        $oystCheckout->setUser($this->buildOystCheckoutUser($quote->getCustomer(), $quote));
        $oystCheckout->setTotals($this->buildOystCheckoutTotals($totals));
        $oystCheckout->setBilling($this->buildOystCheckoutBilling($quote));
        $oystCheckout->setItems($this->buildOystCheckoutItemsFacade($quote->getAllItems(), $products));
        $oystCheckout->setShop($this->buildOystCommonShop($quote->getStore()));

        if (!$quote->isVirtual()) {
            $oystCheckout->setShipping($this->buildOystCheckoutShipping($quote, $shippingMethods));
            $oystCheckout->setDiscounts($this->buildOystCheckoutDiscounts($quote->getShippingAddress()->getTotals()));
        } else {
            $oystCheckout->setDiscounts($this->buildOystCheckoutDiscounts($quote->getBillingAddress()->getTotals()));
        }

        if ($quote->getCouponCode()) {
            $oystCheckout->setCoupons($this->buildOystCheckoutCoupons($quote->getCouponCode()));
        }

        return $oystCheckout;
    }

    protected function buildOystCheckoutTotals(
        \Magento\Quote\Api\Data\TotalsInterface $totals
    )
    {
        /* @var $oystCheckoutTotals \Oyst\OneClick\Api\Data\Common\TotalsInterface */
        $oystCheckoutTotals = $this->oystCommonTotalsFactory->create();

        $oystCheckoutTotals->setDetailsTaxIncl($this->buildOystCheckoutTotalDetailsTaxIncl($totals));
        $oystCheckoutTotals->setDetailsTaxExcl($this->buildOystCheckoutTotalDetailsTaxExcl($totals));

        return $oystCheckoutTotals;
    }

    protected function buildOystCheckoutTotalDetailsTaxIncl(
        \Magento\Quote\Api\Data\TotalsInterface $totals
    )
    {
        /* @var $oystCheckoutTotalDetails \Oyst\OneClick\Api\Data\Common\TotalDetailsInterface */
        $oystCheckoutTotalDetails = $this->oystCommonTotalDetailsFactory->create();

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
        /* @var $oystCheckoutTotalDetails \Oyst\OneClick\Api\Data\Common\TotalDetailsInterface */
        $oystCheckoutTotalDetails = $this->oystCommonTotalDetailsFactory->create();

        $oystCheckoutTotalDetails->setTotal($totals->getGrandTotal() - $totals->getTaxAmount());
        /*$oystCheckoutTotalDetails->setTotalDiscount($totals->getDiscountAmount());
        $oystCheckoutTotalDetails->setTotalItems($totals->getSubtotalInclTax());
        $oystCheckoutTotalDetails->setTotalShipping($totals->getShippingInclTax());*/

        return $oystCheckoutTotalDetails;
    }

    protected function buildOystCheckoutItemsFacade(
        array $items,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $products
    )
    {
        $oystCheckoutItems = [];

        $itemsByParentItemId = [];
        foreach ($items as $item) {
            if ($item->getData('parent_item_id')) {
                $itemsByParentItemId[$item->getData('parent_item_id')][] = $item;
            }
        }

        foreach ($items as $item) {
            if (!$item->getData('parent_item_id')) {
                $childItems = isset($itemsByParentItemId[$item->getId()]) ? $itemsByParentItemId[$item->getId()] : null;
                $oystCheckoutItems[] = $this->buildOystCheckoutItem($products, $item, $childItems);
            }
        }

        return $oystCheckoutItems;
    }

    protected function buildOystCheckoutItem(
        \Magento\Catalog\Model\ResourceModel\Product\Collection $products,
        \Magento\Quote\Model\Quote\Item $item,
        array $childItems = null
    )
    {
        /* @var $item \Magento\Quote\Model\Quote\Item */
        /* @var $childItems \Magento\Quote\Model\Quote\Item[] */
        $product = $products->getItemById($item->getProductId());
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
        $oystCheckoutItem->setImage($product->getOystImageUrl());
        if ($this->helperSalesRule->isItemFreeProduct($item)) {
            $oystCheckoutItem->setOystDisplay(HelperConstants::OYST_DISPLAY_FREE);
        } else {
            $oystCheckoutItem->setOystDisplay(HelperConstants::OYST_DISPLAY_NORMAL);
        }

        if (isset($childItems) && $item->getProductType() == \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE) {
            $this->addVariantInfosToOystCheckoutItem($oystCheckoutItem, $products, $item, $childItems[0]);
        } elseif (isset($childItems) && $item->getProductType() == \Magento\Bundle\Model\Product\Type::TYPE_CODE) {
            $this->addBundleInfosToOystCheckoutItem($oystCheckoutItem, $products, $childItems);
        }

        return $oystCheckoutItem;
    }

    protected function addVariantInfosToOystCheckoutItem(
        \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface $oystCheckoutItem,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $products,
        \Magento\Quote\Model\Quote\Item $item,
        \Magento\Quote\Model\Quote\Item $childItem
    )
    {
        $product = $products->getItemById($item->getProductId());
        $childProduct = $products->getItemById($childItem->getProductId());

        $attributesVariant = [];
        $configurableAttributes = $product->getTypeInstance()->getConfigurableAttributes($product);
        foreach ($configurableAttributes as $configurableAttribute) {
            /* @var $oystCheckoutItemAttribute \Oyst\OneClick\Api\Data\Common\ItemAttributeInterface */
            $oystCheckoutItemAttribute = $this->oystCommonItemAttributeInterfaceFactory->create();

            $options = $configurableAttribute->getProductAttribute()->getSource()->getAllOptions(false);

            $oystCheckoutItemAttribute->setCode($configurableAttribute->getProductAttribute()->getAttributeCode());
            $oystCheckoutItemAttribute->setLabel($configurableAttribute->getProductAttribute()->getStoreLabel());
            foreach ($configurableAttribute->getProductAttribute()->getSource()->getAllOptions(false) as $option) {
                if ($option['value'] == $childProduct->getData($configurableAttribute->getProductAttribute()->getAttributeCode())) {
                    $oystCheckoutItemAttribute->setValue($option['label']);
                }
            }

            $attributesVariant[] = $oystCheckoutItemAttribute;
        }

        $oystCheckoutItem->setAttributesVariant($attributesVariant);
        $oystCheckoutItem->setChildItems([$this->buildOystCheckoutItem($products, $childItem)]);
    }

    protected function addBundleInfosToOystCheckoutItem(
        \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface $oystCheckoutItem,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $products,
        array $childItems
    )
    {
        $childOystCheckoutItems = [];
        foreach($childItems as $childItem) {
            $childOystCheckoutItems[] = $this->buildOystCheckoutItem($products, $childItem);
        }
        $oystCheckoutItem->setChildItems($childOystCheckoutItems);
    }

    protected function buildOystCheckoutItemPrice(
        \Magento\Quote\Model\Quote\Item $item
    )
    {
        /* @var $oystCheckoutItemPrice \Oyst\OneClick\Api\Data\Common\ItemPriceInterface */
        $oystCheckoutItemPrice = $this->oystCommonItemPriceFactory->create();

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
        /* @var $oystCheckoutAddress \Oyst\OneClick\Api\Data\Common\AddressInterface */
        $oystCheckoutAddress = $this->oystCommonAddressFactory->create();

        $oystCheckoutAddress->setFirstname($address->getFirstname());
        $oystCheckoutAddress->setLastname($address->getLastname());
        $oystCheckoutAddress->setEmail($address->getEmail());
        $oystCheckoutAddress->setCity($address->getCity());
        $oystCheckoutAddress->setPostcode($address->getPostcode());
        $oystCheckoutAddress->setCountry($this->buildOystCommonCountry($address->getCountryModel()->getCountryId(), $address->getCountryModel()->getName()));
        $oystCheckoutAddress->setStreet1($address->getStreetLine(1));
        $oystCheckoutAddress->setStreet2($address->getStreetLine(2));
        $oystCheckoutAddress->setPhoneMobile($address->getTelephone());
        $oystCheckoutAddress->setPhone($address->getTelephone());

        return $oystCheckoutAddress;
    }

    protected function buildOystCheckoutBilling(
        \Magento\Quote\Model\Quote $quote
    )
    {
        /* @var $oystCheckoutBilling \Oyst\OneClick\Api\Data\Common\BillingInterface */
        $oystCheckoutBilling = $this->oystCommonBillingFactory->create();

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
        $oystCheckoutShipping->setMethodApplied($this->buildOystCheckoutShippingMethodApplied($quote->getShippingAddress()->getShippingMethod(), $shippingMethods));

        return $oystCheckoutShipping;
    }

    protected function buildOystCheckoutShippingMethodsAvailable(
        array $shippingMethods
    )
    {
        $oystCheckoutShippingMethods = [];

        foreach ($shippingMethods as $shippingMethod) {
            /* @var $shippingMethod \Magento\Quote\Api\Data\ShippingMethodInterface */
            /* @var $oystCheckoutShippingMethod \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface */
            $oystCheckoutShippingMethod = $this->oystCommonShippingMethodFactory->create();

            $oystCheckoutShippingMethod->setAmountTaxExcl($shippingMethod->getPriceExclTax());
            $oystCheckoutShippingMethod->setAmountTaxIncl($shippingMethod->getPriceInclTax());
            $oystCheckoutShippingMethod->setLabel($shippingMethod->getMethodTitle());
            $oystCheckoutShippingMethod->setReference($shippingMethod->getCarrierCode() . '_' . $shippingMethod->getMethodCode());

            $oystCheckoutShippingMethods[] = $oystCheckoutShippingMethod;
        }

        return $oystCheckoutShippingMethods;
    }

    protected function buildOystCheckoutShippingMethodApplied(
        $shippingMethod,
        array $shippingMethods
    )
    {
        foreach ($this->buildOystCheckoutShippingMethodsAvailable($shippingMethods) as $oystCheckoutShippingMethod) {
            if ($oystCheckoutShippingMethod->getReference() == $shippingMethod) {
                return $oystCheckoutShippingMethod;
            }
        }

        return null;
    }

    protected function buildOystCheckoutUser(
        \Magento\Customer\Api\Data\CustomerInterface $customer,
        \Magento\Quote\Model\Quote $quote
    )
    {
        /* @var $oystCommonUser \Oyst\OneClick\Api\Data\Common\UserInterface */
        $oystCommonUser = $this->oystCommonUserFactory->create();

        if ($customer->getId()) {
            $oystCommonUser->setEmail($customer->getEmail());
            $oystCommonUser->setFirstname($customer->getFirstname());
            $oystCommonUser->setLastname($customer->getLastname());
        } else {
            $oystCommonUser->setEmail($quote->getCustomerEmail());
            $oystCommonUser->setFirstname($quote->getCustomerFirstname());
            $oystCommonUser->setLastname($quote->getCustomerLastname());
        }

        return $oystCommonUser;
    }

    protected function buildOystCheckoutDiscounts(array $totals)
    {
        $oystCheckoutDiscounts = [];

        foreach ($totals as $total) {
            if ($total->getData('code') == 'discount') {
                /* @var $oystCheckoutDiscount \Oyst\OneClick\Api\Data\Common\DiscountInterface */
                $oystCheckoutDiscount = $this->oystCommonDiscountFactory->create();
                $oystCheckoutDiscount->setLabel($total->getData('title')->__toString());
                $oystCheckoutDiscount->setAmountTaxIncl($total->getData('value'));

                $oystCheckoutDiscounts[] = $oystCheckoutDiscount;
            }
        }

        return $oystCheckoutDiscounts;
    }

    protected function buildOystCheckoutCoupons($couponCode)
    {
        $oystCheckoutCoupons = [];

        /* @var $oystCheckoutCoupon \Oyst\OneClick\Api\Data\Common\CouponInterface */
        $oystCheckoutCoupon = $this->oystCommonCouponFactory->create();
        $oystCheckoutCoupon->setCode($couponCode);

        $oystCheckoutCoupons[] = $oystCheckoutCoupon;

        return $oystCheckoutCoupons;
    }
}
