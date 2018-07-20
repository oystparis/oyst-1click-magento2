<?php

namespace Oyst\OneClick\Model\Data\Common;

class UserAdvantages extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\UserAdvantagesInterface
{
    public function getFidelityPoints()
    {
        return $this->_get(self::FIDELITY_POINTS);
    }

    public function setFidelityPoints($fidelityPoints)
    {
        return $this->setData(self::FIDELITY_POINTS , $fidelityPoints);
    }

    public function getBalance()
    {
        return $this->_get(self::BALANCE);
    }

    public function setBalance($balance)
    {
        return $this->setData(self::BALANCE , $balance);
    }
}
