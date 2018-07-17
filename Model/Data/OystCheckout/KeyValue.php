<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class KeyValue extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\KeyValueInterface
{
    public function getKey()
    {
        return $this->_get(self::KEY);
    }

    public function setKey($key)
    {
        return $this->setData(self::KEY , $key);
    }

    public function getValue()
    {
        return $this->_get(self::VALUE);
    }

    public function setValue($value)
    {
        return $this->setData(self::VALUE , $value);
    }
}
