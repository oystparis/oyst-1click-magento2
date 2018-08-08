<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class UserAdvantages extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesInterface
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
    
    public function getFidelityPointsAvailable()
    {
        return $this->_get(self::FIDELITY_POINTS_AVAILABLE);
    }

    public function setFidelityPointsAvailable($fidelityPointsAvailable)
    {
        return $this->setData(self::FIDELITY_POINTS_AVAILABLE , $fidelityPointsAvailable);
    }

    public function getBalanceAvailable()
    {
        return $this->_get(self::BALANCE_AVAILABLE);
    }

    public function setBalanceAvailable($balanceAvailable)
    {
        return $this->setData(self::BALANCE_AVAILABLE , $balanceAvailable);
    }
}
