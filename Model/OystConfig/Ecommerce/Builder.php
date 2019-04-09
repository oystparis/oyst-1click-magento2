<?php

namespace Oyst\OneClick\Model\OystConfig\Ecommerce;

class Builder
{
    protected $oystConfigEcommerceFactory;

    protected $oystCommonShippingMethodFactory;

    protected $oystCommonCountryFactory;

    protected $oystCommonOrderStatusFactory;

    protected $oystCommonShopFactory;

    public function __construct(
        \Oyst\OneClick\Api\Data\OystConfig\EcommerceInterfaceFactory $oystConfigEcommerceFactory,
        \Oyst\OneClick\Api\Data\Common\ShippingMethodInterfaceFactory $oystCommonShippingMethodFactory,
        \Oyst\OneClick\Api\Data\Common\CountryInterfaceFactory $oystCommonCountryFactory,
        \Oyst\OneClick\Api\Data\Common\OrderStatusInterfaceFactory $oystCommonOrderStatusFactory,
        \Oyst\OneClick\Api\Data\Common\ShopInterfaceFactory $oystCommonShopFactory
    )
    {
        $this->oystConfigEcommerceFactory = $oystConfigEcommerceFactory;
        $this->oystCommonShippingMethodFactory = $oystCommonShippingMethodFactory;
        $this->oystCommonCountryFactory = $oystCommonCountryFactory;
        $this->oystCommonOrderStatusFactory = $oystCommonOrderStatusFactory;
        $this->oystCommonShopFactory = $oystCommonShopFactory;
    }

    public function buildOystConfigEcommerce(
        array $carriers,
        array $countries,
        array $orderStatuses,
        array $stores
    )
    {
        /* @var $oystConfigEcommerce \Oyst\OneClick\Api\Data\OystConfig\EcommerceInterface */
        $oystConfigEcommerce = $this->oystConfigEcommerceFactory->create();

        $oystConfigEcommerce->setShippingMethods($this->buildOystConfigEcommerceShippingMethods($carriers));
        $oystConfigEcommerce->setCountries($this->buildOystConfigEcommerceCountries($countries));
        $oystConfigEcommerce->setOrderStatuses($this->buildOystConfigEcommerceOrderStatuses($orderStatuses));
        $oystConfigEcommerce->setShops($this->buildOystConfigEcommerceShops($stores));

        return $oystConfigEcommerce;
    }

    protected function buildOystConfigEcommerceShippingMethods(array $carriers)
    {
        $result = [];

        foreach ($carriers as $carrier) {
            foreach ($carrier['value'] as $shippingMethod) {
                /* @var $oystConfigEcommerceShippingMethod \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface */
                $oystConfigEcommerceShippingMethod = $this->oystCommonShippingMethodFactory->create();

                $oystConfigEcommerceShippingMethod->setLabel($shippingMethod['label']);
                $oystConfigEcommerceShippingMethod->setReference($shippingMethod['value']);

                $result[] = $oystConfigEcommerceShippingMethod;
            }
        }

        return $result;
    }

    protected function buildOystConfigEcommerceCountries(array $countries)
    {
        $result = [];

        foreach ($countries as $country) {
            /* @var $oystConfigEcommerceCountry \Oyst\OneClick\Api\Data\Common\CountryInterface */
            $oystConfigEcommerceCountry = $this->oystCommonCountryFactory->create();

            $oystConfigEcommerceCountry->setLabel($country['label']);
            $oystConfigEcommerceCountry->setCode($country['value']);

            $result[] = $oystConfigEcommerceCountry;
        }

        return $result;
    }

    protected function buildOystConfigEcommerceOrderStatuses(array $orderStatuses)
    {
        $result = [];

        foreach ($orderStatuses as $key => $label) {
            /* @var $oystConfigEcommerceOrderStatus \Oyst\OneClick\Api\Data\Common\OrderStatusInterface */
            $oystConfigEcommerceOrderStatus = $this->oystCommonOrderStatusFactory->create();

            $oystConfigEcommerceOrderStatus->setLabel($label);
            $oystConfigEcommerceOrderStatus->setCode($key);

            $result[] = $oystConfigEcommerceOrderStatus;
        }

        return $result;
    }

    protected function buildOystConfigEcommerceShops(array $stores)
    {
        $result = [];

        foreach ($stores as $store) {
            /* @var $oystConfigEcommerceShop \Oyst\OneClick\Api\Data\Common\ShopInterface */
            $oystConfigEcommerceShop = $this->oystCommonShopFactory->create();

            $oystConfigEcommerceShop->setCode($store->getCode());
            $oystConfigEcommerceShop->setLabel($store->getName());
            $oystConfigEcommerceShop->setUrl($store->getBaseUrl());

            $result[] = $oystConfigEcommerceShop;
        }

        return $result;
    }
}