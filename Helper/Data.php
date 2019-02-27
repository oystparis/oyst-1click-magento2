<?php

namespace Oyst\OneClick\Helper;

class Data
{
    protected $coreRegistry;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->coreRegistry = $coreRegistry;
    }

    public function handleExceptionForWebapi(\Exception $e)
    {
        $this->coreRegistry->register(
            \Oyst\OneClick\Helper\Constants::WEBAPI_ERROR_REGISTRY_KEY,
            [
                'type' => \Oyst\OneClick\Helper\Constants::WEBAPI_TYPE_ERROR,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]
        );
    }

    public function addQuoteExtraData(\Magento\Quote\Model\Quote $quote, $key, $value)
    {
        $extraData = json_decode($quote->getOystExtraData(), true);

        if(empty($extraData)) {
            $extraData = array();
        }

        $extraData[$key] = $value;

        $quote->setOystExtraData(json_encode($extraData));
    }

    public function getSalesObjectExtraData(\Magento\Framework\Model\AbstractExtensibleModel $salesObject, $key)
    {
        $extraData = json_decode($salesObject->getOystExtraData(), true);
        return isset($extraData[$key]) ? $extraData[$key] : null;
    }
}