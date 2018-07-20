<?php

namespace Oyst\OneClick\Model\Data\Common;

class ShippingMethod extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface
{
    public function getReference()
    {
        return $this->_get(self::REFERENCE);
    }

    public function setReference($reference)
    {
        return $this->setData(self::REFERENCE , $reference);
    }

    public function getLabel()
    {
        return $this->_get(self::LABEL);
    }

    public function setLabel($label)
    {
        return $this->setData(self::LABEL , $label);
    }

    public function getDeliveryDelay()
    {
        return $this->_get(self::DELIVERY_DELAY);
    }

    public function setDeliveryDelay($deliveryDelay)
    {
        return $this->setData(self::DELIVERY_DELAY , $deliveryDelay);
    }

    public function getAmountTaxExcl()
    {
        return $this->_get(self::AMOUNT_TAX_EXCL);
    }

    public function setAmountTaxExcl($amountTaxExcl)
    {
        return $this->setData(self::AMOUNT_TAX_EXCL , $amountTaxExcl);
    }

    public function getAmountTaxIncl()
    {
        return $this->_get(self::AMOUNT_TAX_INCL);
    }

    public function setAmountTaxIncl($amountTaxIncl)
    {
        return $this->setData(self::AMOUNT_TAX_INCL , $amountTaxIncl);
    }
}
