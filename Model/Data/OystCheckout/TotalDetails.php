<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class TotalDetails extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\TotalDetailsInterface
{
    public function getTotalItems()
    {
        return $this->_get(self::TOTAL_ITEMS);
    }

    public function setTotalItems($totalItems)
    {
        return $this->setData(self::TOTAL_ITEMS , $totalItems);
    }

    public function getTotalShipping()
    {
        return $this->_get(self::TOTAL_SHIPPING);
    }

    public function setTotalShipping($totalShipping)
    {
        return $this->setData(self::TOTAL_SHIPPING , $totalShipping);
    }

    public function getTotalDiscount()
    {
        return $this->_get(self::TOTAL_DISCOUNT);
    }

    public function setTotalDiscount($totalDiscount)
    {
        return $this->setData(self::TOTAL_DISCOUNT , $totalDiscount);
    }

    public function getTotal()
    {
        return $this->_get(self::TOTAL);
    }

    public function setTotal($total)
    {
        return $this->setData(self::TOTAL , $total);
    }
}
