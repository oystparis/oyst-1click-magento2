<?php

namespace Oyst\OneClick\Model\Data\Common;

class Shipping extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\ShippingInterface
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

    public function getMethodApplied()
    {
        return $this->_get(self::METHOD_APPLIED);
    }

    public function setMethodApplied($methodApplied)
    {
        return $this->setData(self::METHOD_APPLIED , $methodApplied);
    }
}
