<?php

namespace Oyst\OneClick\Model\Data\Common;

class PaymentTransaction extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\PaymentTransactionInterface
{
    public function getId()
    {
        return $this->_get(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID , $id);
    }

    public function getAmount()
    {
        return $this->_get(self::AMOUNT);
    }

    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT , $amount);
    }

    public function getCurrency()
    {
        return $this->_get(self::CURRENCY);
    }

    public function setCurrency($currency)
    {
        return $this->setData(self::CURRENCY , $currency);
    }   
}