<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class Billing extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\BillingInterface
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
