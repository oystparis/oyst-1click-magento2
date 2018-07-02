<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class Shipping extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface
{
    public function getAddress()
    {
        return $this->_get(self::ADDRESS);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS , $address);
    }

    public function getMethodsAvailable()
    {
        return $this->_get(self::METHODS_AVAILABLE);
    }

    public function setMethodsAvailable($methodsAvailable)
    {
        return $this->setData(self::METHODS_AVAILABLE , $methodsAvailable);
    }

    public function getMethodUsed()
    {
        return $this->_get(self::METHOD_USED);
    }

    public function setMethodUsed($methodUsed)
    {
        return $this->setData(self::METHOD_USED , $methodUsed);
    }
}
