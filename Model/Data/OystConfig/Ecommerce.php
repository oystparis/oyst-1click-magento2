<?php

namespace Oyst\OneClick\Model\Data\OystConfig;

class Ecommerce extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystConfig\EcommerceInterface
{
    public function getShippingMethods()
    {
        return $this->_get(self::SHIPPING_METHODS);
    }

    public function setShippingMethods($shippingMethods)
    {
        return $this->setData(self::SHIPPING_METHODS , $shippingMethods);
    }

    public function getCountries()
    {
        return $this->_get(self::COUNTRIES);
    }

    public function setCountries($countries)
    {
        return $this->setData(self::COUNTRIES , $countries);
    }

    public function getOrderStatuses()
    {
        return $this->_get(self::ORDER_STATUSES);
    }

    public function setOrderStatuses($orderStatuses)
    {
        return $this->setData(self::ORDER_STATUSES , $orderStatuses);
    }

    public function getShops()
    {
        return $this->_get(self::SHOPS);
    }

    public function setShops($shops)
    {
        return $this->setData(self::SHOPS , $shops);
    }
}

