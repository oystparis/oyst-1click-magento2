<?php

namespace Oyst\OneClick\Model\Data\Common;

class Coupon extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\CounponInterface
{
    public function getCode()
    {
        return $this->_get(self::CODE);
    }

    public function setCode($code)
    {
        return $this->setData(self::CODE , $code);
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
