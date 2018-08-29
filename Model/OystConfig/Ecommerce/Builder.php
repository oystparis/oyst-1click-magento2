<?php

namespace Oyst\OneClick\Model\OystConfig\Ecommerce;

class Builder
{
    protected $oystConfigEcommerceFactory;

    protected $oystCommonShippingMethodFactory;

    protected $oystCommonCountryFactory;

    protected $oystCommonOrderStatusFactory;

    public function __construct(
        \Oyst\OneClick\Api\Data\OystConfig\EcommerceInterfaceFactory $oystConfigEcommerceFactory,
        \Oyst\OneClick\Api\Data\Common\ShippingMethodInterfaceFactory $oystCommonShippingMethodFactory,
        \Oyst\OneClick\Api\Data\Common\CountryInterfaceFactory $oystCommonCountryFactory,
        \Oyst\OneClick\Api\Data\Common\OrderStatusInterfaceFactory $oystCommonOrderStatusFactory
    )
    {
        $this->oystConfigEcommerceFactory = $oystConfigEcommerceFactory;
        $this->oystCommonShippingMethodFactory = $oystCommonShippingMethodFactory;
        $this->oystCommonCountryFactory = $oystCommonCountryFactory;
        $this->oystCommonOrderStatusFactory = $oystCommonOrderStatusFactory;
    }

    public function buildOystConfigEcommerce(
        array $carriers,
        array $countries,
        array $orderStatuses
    )
    {
        /* @var $oystConfigEcommerce \Oyst\OneClick\Api\Data\OystConfig\EcommerceInterface */
        $oystConfigEcommerce = $this->oystConfigEcommerceFactory->create();

        $oystConfigEcommerce->setShippingMethods($this->buildOystConfigEcommerceShippingMethods($carriers));
        $oystConfigEcommerce->setCountries($this->buildOystConfigEcommerceCountries($countries));
        $oystConfigEcommerce->setOrderStatuses($this->buildOystConfigEcommerceOrderStatuses($orderStatuses));

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
}