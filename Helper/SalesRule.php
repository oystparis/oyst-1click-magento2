<?php

namespace Oyst\OneClick\Helper;

class SalesRule
{
    public function isItemFreeProduct(\Magento\Quote\Model\Quote\Item $item)
    {
        return $item->getPrice() == 0 && $item->getProduct()->getPrice() > 0;
    }
}
