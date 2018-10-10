<?php

namespace Oyst\OneClick\Model\Data;

class OystRefund extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystRefundInterface
{
    public function getAmount()
    {
        return $this->_get(self::AMOUNT);
    }

    public function getCurrency()
    {
        return $this->_get(self::CURRENCY);
    }

    public function getTransactionId()
    {
        return $this->_get(self::TRANSACTION_ID);
    }

    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT, $amount);
    }

    public function setCurrency($currency)
    {
        return $this->setData(self::CURRENCY, $currency);
    }

    public function setTransactionId($transactionId)
    {
        return $this->setData(self::TRANSACTION_ID, $transactionId);
    }
}