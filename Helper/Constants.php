<?php

namespace Oyst\OneClick\Helper;

class Constants
{
    const MODULE_NAME = 'Oyst_OneClick';
    
    const ITEM_TYPE_SIMPLE = 'simple';
    const ITEM_TYPE_VIRTUAL = 'virtual';
    const ITEM_TYPE_VARIANT = 'variant';
    const ITEM_TYPE_BUNDLE = 'bundle';
    const ITEM_TYPE_DOWNLOADABLE = 'downloadable';

    const OYST_DISPLAY_NORMAL = 'normal';
    const OYST_DISPLAY_FREE = 'free';
    const OYST_DISPLAY_PROPOSAL = 'proposal';

    const OYST_GATEWAY_ENDPOINT_TYPE_CAPTURE = 'capture';
    const OYST_GATEWAY_ENDPOINT_TYPE_REFUND = 'refund';
    
    const OYST_API_ORDER_STATUS_CANCELED = 'oyst_canceled';
    const OYST_API_ORDER_STATUS_PAYMENT_CAPTURED = 'oyst_payment_captured';
    const OYST_API_ORDER_STATUS_PAYMENT_WAITING_TO_CAPTURE = 'oyst_payment_waiting_to_capture';

    const OYST_ORDER_STATUS_CANCELED = 'oyst_canceled';
    const OYST_ORDER_STATUS_PAYMENT_WAITING_VALIDATION = 'oyst_payment_waiting_validation';
    const OYST_ORDER_STATUS_PAYMENT_CAPTURED = 'oyst_payment_captured';
    const OYST_ORDER_STATUS_PAYMENT_WAITING_TO_CAPTURE = 'oyst_payment_waiting_to_capture';
    const OYST_ORDER_STATUS_PAYMENT_TO_CAPTURE = 'oyst_payment_to_capture';

    const CONFIG_PATH_OYST_CONFIG_MERCHANT_ID = 'oyst_oneclick/general/merchant_id';
    const CONFIG_PATH_OYST_CONFIG_SCRIPT_TAG = 'oyst_oneclick/general/script_tag';
    const CONFIG_PATH_OYST_CONFIG_ENDPOINTS = 'oyst_oneclick/general/endpoints';
    const CONFIG_PATH_OYST_CONFIG_CREATE_CUSTOMER_ON_OYST_ORDER = 'oyst_oneclick/general/create_customer_on_oyst_order';

    const INTEGRATION_NAME = 'Oyst OneClick';

    const DISABLE_REGION_REQUIRED_REGISTRY_KEY = 'oyst_oneclick_disable_region_required';
    const WEBAPI_ERROR_REGISTRY_KEY = 'oyst_oneclick_webapi_error';

    const WEBAPI_ERROR_PLATFORM = 'MAGENTO2';
    
    const MERCHANT_ID_PLACEHOLDER = '[MERCHANT_ID_PLACEHOLDER]';
}
