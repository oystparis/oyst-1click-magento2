<?php

namespace Oyst\OneClick\Model\Data\Common;

class UserAdvantagesBalance extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\UserAdvantagesBalanceInterface
{
    public function getAmount()
    {
        return $this->_get(self::AMOUNT);
    }

    public function setAmount($amount)
    {
        return $this->setData(self::AMOUNT , $amount);
    }

    public function getLabel()
    {
        return $this->_get(self::LABEL);
    }

    public function setLabel($label)
    {
        return $this->setData(self::LABEL , $label);
    }
}
