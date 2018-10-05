<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class Payment extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\PaymentInterface
{
    public function getMethod()
    {
        return $this->_get(self::METHOD);
    }

    public function setMethod($method)
    {
        return $this->setData(self::METHOD , $method);
    }
}