<?php

namespace Oyst\OneClick\Model\Data\Common;

class UserAdvantagesFidelityPoint extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\UserAdvantagesFidelityPointInterface
{
    public function getQuantity()
    {
        return $this->_get(self::QUANTITY);
    }

    public function setQuantity($quantity)
    {
        return $this->setData(self::QUANTITY , $quantity);
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
