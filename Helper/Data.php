<?php

namespace Oyst\OneClick\Helper;

class Data
{
    protected $coreRegistry;

    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->coreRegistry = $coreRegistry;
        $this->scopeConfig = $scopeConfig;
    }

    public function handleExceptionForWebapi(\Exception $e)
    {
        throw $e;
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

    public function handleQuoteErrors(\Magento\Quote\Model\Quote $quote)
    {
        if ($quote->getHasError()) {
            $errorMessages = array();
            foreach ($quote->getErrors() as $error) {
                $errorMessages[] = $error->getCode();
            }
            throw new \Exception(implode('\n', $errorMessages));
        }
        return $this;
    }

    public function mapMagentoExceptionCodeToOystErrorCode($exceptionCode)
    {
        switch($exceptionCode) {
            case 1:
                return 'unhandled-address';
            default:
                return 'generic-error';
        }
    }

    public function validateAddress(\Magento\Customer\Model\Address\AbstractAddress $address, $store = null)
    {
        if (($validateRes = $address->validate()) !== true) {
            throw new \Exception(implode('\n', $validateRes));
        }

        $allowCountries = explode(',', (string)$this->scopeConfig->getValue('general/country/allow'));
        if (!in_array($address->getCountryId(), $allowCountries)) {
            throw new \Exception('', 1);
        }

        return $this;
    }
    
    public function isWebApiRequestConcernOystOneClick(\Magento\Framework\Webapi\Request $request)
    {
        return strpos($request->getRequestUri(), \Oyst\OneClick\Helper\Constants::WEBAPI_REQUEST_PATTERN) !== false; 
    }
}