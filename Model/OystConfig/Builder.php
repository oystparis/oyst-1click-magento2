<?php

namespace Oyst\OneClick\Model\OystConfig;

class Builder
{
    protected $oystConfigFactory;

    protected $oystCommonShippingMethodFactory;

    protected $oystCommonCountryFactory;

    protected $oystCommonOrderStatusFactory;

    public function __construct(
        \Oyst\OneClick\Api\Data\OystConfigInterfaceFactory $oystConfigFactory,
        \Oyst\OneClick\Api\Data\Common\ShippingMethodInterfaceFactory $oystCommonShippingMethodFactory,
        \Oyst\OneClick\Api\Data\Common\CountryInterfaceFactory $oystCommonCountryFactory,
        \Oyst\OneClick\Api\Data\Common\OrderStatusInterfaceFactory $oystCommonOrderStatusFactory
    )
    {
        $this->oystConfigFactory = $oystConfigFactory;
        $this->oystCommonShippingMethodFactory = $oystCommonShippingMethodFactory;
        $this->oystCommonCountryFactory = $oystCommonCountryFactory;
        $this->oystCommonOrderStatusFactory = $oystCommonOrderStatusFactory;
    }

    public function buildOystConfig(
        array $carriers,
        array $countries,
        array $orderStatuses
    )
    {
        /* @var $oystConfig \Oyst\OneClick\Api\Data\OystConfigInterface */
        $oystConfig = $this->oystConfigFactory->create();

        $oystConfig->setShippingMethods($this->buildOystConfigShippingMethods($carriers));
        $oystConfig->setCountries($this->buildOystConfigCountries($countries));
        $oystConfig->setOrderStatuses($this->buildOystConfigOrderStatuses($orderStatuses));

        return $oystConfig;
    }

    protected function buildOystConfigShippingMethods(array $carriers)
    {
        $result = [];

        foreach ($carriers as $carrier) {
            foreach ($carrier['value'] as $shippingMethod) {
                /* @var $oystConfigShippingMethod \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface */
                $oystConfigShippingMethod = $this->oystCommonShippingMethodFactory->create();

                $oystConfigShippingMethod->setLabel($shippingMethod['label']);
                $oystConfigShippingMethod->setReference($shippingMethod['value']);

                $result[] = $oystConfigShippingMethod;
            }
        }

        return $result;
    }

    protected function buildOystConfigCountries(array $countries)
    {
        $result = [];

        foreach ($countries as $country) {
            /* @var $oystConfigCountry \Oyst\OneClick\Api\Data\Common\CountryInterface */
            $oystConfigCountry = $this->oystCommonCountryFactory->create();

            $oystConfigCountry->setLabel($country['label']);
            $oystConfigCountry->setCode($country['value']);

            $result[] = $oystConfigCountry;
        }

        return $result;
    }

    protected function buildOystConfigOrderStatuses(array $orderStatuses)
    {
        $result = [];

        foreach ($orderStatuses as $key => $label) {
            /* @var $oystConfigOrderStatus \Oyst\OneClick\Api\Data\Common\OrderStatusInterface */
            $oystConfigOrderStatus = $this->oystCommonOrderStatusFactory->create();

            $oystConfigOrderStatus->setLabel($label);
            $oystConfigOrderStatus->setCode($key);

            $result[] = $oystConfigOrderStatus;
        }

        return $result;
    }
}