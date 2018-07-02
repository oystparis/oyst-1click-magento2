<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class Totals extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterface
{
    public function getDetailsTaxIncl()
    {
        return $this->_get(self::DETAILS_TAX_INCL);
    }

    public function setDetailsTaxIncl($detailsTaxIncl)
    {
        return $this->setData(self::DETAILS_TAX_INCL , $detailsTaxIncl);
    }

    public function getDetailsTaxExcl()
    {
        return $this->_get(self::DETAILS_TAX_EXCL);
    }

    public function setDetailsTaxExcl($detailsTaxExcl)
    {
        return $this->setData(self::DETAILS_TAX_EXCL , $detailsTaxExcl);
    }

    public function getTaxes()
    {
        return $this->_get(self::TAXES);
    }

    public function setTaxes($taxes)
    {
        return $this->setData(self::TAXES , $taxes);
    }
}
