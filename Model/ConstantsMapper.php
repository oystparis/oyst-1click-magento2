<?php

namespace Oyst\OneClick\Model;

use \Oyst\OneClick\Helper\Constants as HelperConstants;

class ConstantsMapper
{
    public function mapMagentoProductTypeToOystCheckoutItemType($magentoProductType)
    {
        $result = null;

        switch($magentoProductType) {
            case \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE:
                $result = HelperConstants::ITEM_TYPE_SIMPLE;
                break;
            case \Magento\Catalog\Model\Product\Type::TYPE_VIRTUAL:
                $result = HelperConstants::ITEM_TYPE_VIRTUAL;
                break;
            case \Magento\Bundle\Model\Product\Type::TYPE_CODE:
                $result = HelperConstants::ITEM_TYPE_BUNDLE;
                break;
            case \Magento\Downloadable\Model\Product\Type::TYPE_DOWNLOADABLE:
                $result = HelperConstants::ITEM_TYPE_DOWNLOADABLE;
                break;
            case \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE:
                $result = HelperConstants::ITEM_TYPE_VARIANT;
                break;
        }

        return $result;
    }
}