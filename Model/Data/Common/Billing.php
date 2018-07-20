<?php

namespace Oyst\OneClick\Model\Data\Common;

class Billing extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\BillingInterface
{
    public function getAddress()
    {
        return $this->_get(self::ADDRESS);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS , $address);
    }
}
