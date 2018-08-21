<?php

namespace Oyst\OneClick\Helper;

class Constants
{
    const ITEM_TYPE_SIMPLE = 'simple';
    const ITEM_TYPE_VIRTUAL = 'virtual';
    const ITEM_TYPE_VARIANT = 'variant';
    const ITEM_TYPE_BUNDLE = 'bundle';
    const ITEM_TYPE_DOWNLOADABLE = 'downloadable';

    const OYST_DISPLAY_NORMAL = 'normal';
    const OYST_DISPLAY_FREE = 'free';
    const OYST_DISPLAY_PROPOSAL = 'proposal';

    const CONFIG_PATH_OYST_CONFIG_SCRIPT_TAG = 'oyst_oneclick/general/script_tag';
    const CONFIG_PATH_OYST_CONFIG_CREATE_CUSTOMER_ON_OYST_ORDER = 'oyst_oneclick/general/create_customer_on_oyst_order';

    const INTEGRATION_NAME = 'Oyst OneClick';

    const DISABLE_REGION_REQUIRED_REGISTRY_KEY = 'oyst_oneclick_disable_region_required';

    const MERCHANT_ID_PLACEHOLDER = '[MERCHANT_ID_PLACEHOLDER]';
}
