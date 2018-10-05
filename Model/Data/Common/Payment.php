<?php

namespace Oyst\OneClick\Model\Data\Common;

class Payment extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\PaymentInterface
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