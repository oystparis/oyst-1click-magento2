<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class ItemPrice extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\ItemPriceInterface
{
    public function getTaxExcl()
    {
        return $this->_get(self::TAX_EXCL);
    }

    public function setTaxExcl($taxExcl)
    {
        return $this->setData(self::TAX_EXCL , $taxExcl);
    }

    public function getTaxIncl()
    {
        return $this->_get(self::TAX_INCL);
    }

    public function setTaxIncl($taxIncl)
    {
        return $this->setData(self::TAX_INCL , $taxIncl);
    }

    public function getWithoutDiscountTaxExcl()
    {
        return $this->_get(self::WITHOUT_DISCOUNT_TAX_EXCL);
    }

    public function setWithoutDiscountTaxExcl($withoutDiscountTaxExcl)
    {
        return $this->setData(self::WITHOUT_DISCOUNT_TAX_EXCL , $withoutDiscountTaxExcl);
    }

    public function getWithoutDiscountTaxIncl()
    {
        return $this->_get(self::WITHOUT_DISCOUNT_TAX_INCL);
    }

    public function setWithoutDiscountTaxIncl($withoutDiscountTaxIncl)
    {
        return $this->setData(self::WITHOUT_DISCOUNT_TAX_INCL , $withoutDiscountTaxIncl);
    }

    public function getTotalTaxExcl()
    {
        return $this->_get(self::TOTAL_TAX_EXCL);
    }

    public function setTotalTaxExcl($totalTaxExcl)
    {
        return $this->setData(self::TOTAL_TAX_EXCL , $totalTaxExcl);
    }

    public function getTotalTaxIncl()
    {
        return $this->_get(self::TOTAL_TAX_INCL);
    }

    public function setTotalTaxIncl($totalTaxIncl)
    {
        return $this->setData(self::TOTAL_TAX_INCL , $totalTaxIncl);
    }
}
