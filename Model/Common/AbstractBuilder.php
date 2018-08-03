<?php

namespace Oyst\OneClick\Model\Common;

abstract class AbstractBuilder
{
    protected $oystCommonUserFactory;

    protected $oystCommonCountryFactory;

    protected $oystCommonShopFactory;

    protected $oystCommonItemFactory;

    protected $oystCommonItemPriceFactory;

    protected $oystCommonTotalsFactory;

    protected $oystCommonTotalDetailsFactory;

    protected $oystCommonAddressFactory;

    protected $oystCommonBillingFactory;

    protected $oystCommonShippingMethodFactory;

    protected $oystCommonDiscountFactory;

    protected $oystCommonCouponFactory;

    protected $oystCommonItemAttributeInterfaceFactory;

    protected $constantsMapper;

    protected $eventManager;

    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Oyst\OneClick\Model\ConstantsMapper $constantsMapper,
        \Oyst\OneClick\Api\Data\Common\AddressInterfaceFactory $oystCommonAddressFactory,
        \Oyst\OneClick\Api\Data\Common\BillingInterfaceFactory $oystCommonBillingFactory,
        \Oyst\OneClick\Api\Data\Common\CountryInterfaceFactory $oystCommonCountryFactory,
        \Oyst\OneClick\Api\Data\Common\CouponInterfaceFactory $oystCommonCouponFactory,
        \Oyst\OneClick\Api\Data\Common\DiscountInterfaceFactory $oystCommonDiscountFactory,
        \Oyst\OneClick\Api\Data\Common\ItemAttributeInterfaceFactory $oystCommonItemAttributeInterfaceFactory,
        \Oyst\OneClick\Api\Data\Common\ItemInterfaceFactory $oystCommonItemFactory,
        \Oyst\OneClick\Api\Data\Common\ItemPriceInterfaceFactory $oystCommonItemPriceFactory,
        \Oyst\OneClick\Api\Data\Common\ShippingMethodInterfaceFactory $oystCommonShippingMethodFactory,
        \Oyst\OneClick\Api\Data\Common\ShopInterfaceFactory $oystCommonShopFactory,
        \Oyst\OneClick\Api\Data\Common\TotalDetailsInterfaceFactory $oystCommonTotalDetailsFactory,
        \Oyst\OneClick\Api\Data\Common\TotalsInterfaceFactory $oystCommonTotalsFactory,
        \Oyst\OneClick\Api\Data\Common\UserInterfaceFactory $oystCommonUserFactory
    )
    {
        $this->eventManager = $eventManager;
        $this->constantsMapper = $constantsMapper;
        $this->oystCommonUserFactory = $oystCommonUserFactory;
        $this->oystCommonCountryFactory = $oystCommonCountryFactory;
        $this->oystCommonShopFactory = $oystCommonShopFactory;
        $this->oystCommonItemFactory = $oystCommonItemFactory;
        $this->oystCommonItemPriceFactory = $oystCommonItemPriceFactory;
        $this->oystCommonTotalsFactory = $oystCommonTotalsFactory;
        $this->oystCommonTotalDetailsFactory = $oystCommonTotalDetailsFactory;
        $this->oystCommonAddressFactory = $oystCommonAddressFactory;
        $this->oystCommonBillingFactory = $oystCommonBillingFactory;
        $this->oystCommonShippingMethodFactory = $oystCommonShippingMethodFactory;
        $this->oystCommonItemAttributeInterfaceFactory = $oystCommonItemAttributeInterfaceFactory;
        $this->oystCommonCouponFactory = $oystCommonCouponFactory;
        $this->oystCommonDiscountFactory = $oystCommonDiscountFactory;
    }

    protected function buildOystCommonCountry($code, $label)
    {
        /* @var $oystCommonCountry \Oyst\OneClick\Api\Data\Common\CountryInterface */
        $oystCommonCountry = $this->oystCommonCountryFactory->create();

        $oystCommonCountry->setCode($code);
        $oystCommonCountry->setLabel($label);

        return $oystCommonCountry;
    }

    protected function buildOystCommonShop(
        \Magento\Store\Model\Store $store
    )
    {
        /* @var $oystCommonShop \Oyst\OneClick\Api\Data\Common\ShopInterface */
        $oystCommonShop = $this->oystCommonShopFactory->create();

        $oystCommonShop->setCode($store->getCode());
        $oystCommonShop->setLabel($store->getName());
        $oystCommonShop->setUrl($store->getBaseUrl());

        return $oystCommonShop;
    }
}
