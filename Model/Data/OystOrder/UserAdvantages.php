<?php

namespace Oyst\OneClick\Model\Data\OystOrder;

class UserAdvantages extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystOrder\UserAdvantagesInterface
{
    public function getFidelityPointsUsed()
    {
        return $this->_get(self::FIDELITY_POINTS_USED);
    }

    public function setFidelityPointsUsed($fidelityPointsUsed)
    {
        return $this->setData(self::FIDELITY_POINTS_USED , $fidelityPointsUsed);
    }

    public function getBalanceUsed()
    {
        return $this->_get(self::BALANCE_USED);
    }

    public function setBalanceUsed($balanceUsed)
    {
        return $this->setData(self::BALANCE_USED , $balanceUsed);
    }
}
