<?php

namespace Oyst\OneClick\Model\Data\Common;

class Discount extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\DiscountInterface
{
    public function getId()
    {
        return $this->_get(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID , $id);
    }

    public function getLabel()
    {
        return $this->_get(self::LABEL);
    }

    public function setLabel($label)
    {
        return $this->setData(self::LABEL , $label);
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
