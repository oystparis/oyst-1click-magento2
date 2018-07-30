<?php

namespace Oyst\OneClick\Model\Data\OystOrder;

class Shipping extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystOrder\ShippingInterface
{
    public function getAddress()
    {
        return $this->_get(self::ADDRESS);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS , $address);
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
