<?php

namespace Oyst\OneClick\Model\Data\OystOrder;

class Payment extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystOrder\PaymentInterface
{
    public function getMethod()
    {
        return $this->_get(self::METHOD);
    }

    public function setMethod($method)
    {
        return $this->setData(self::METHOD , $method);
    }

    public function getLastTransaction()
    {
        return $this->_get(self::LAST_TRANSACTION);
    }

    public function setLastTransaction($lastTransaction)
    {
        return $this->setData(self::LAST_TRANSACTION , $lastTransaction);
    }
}