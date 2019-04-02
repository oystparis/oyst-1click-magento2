<?php

namespace Oyst\OneClick\Model\ResourceModel\Product;

class Collection extends \Magento\Catalog\Model\ResourceModel\Product\Collection
{
    public function isEnabledFlat()
    {
        return false;
    }
}

