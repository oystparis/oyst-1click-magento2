<?php

namespace Oyst\OneClick\Model\Data\OystConfig;

class Oyst extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystConfig\OystInterface
{
    public function getMerchantId()
    {
        return $this->_get(self::MERCHANT_ID);
    }

    public function setMerchantId($merchantId)
    {
        return $this->setData(self::MERCHANT_ID , $merchantId);
    }

    public function getScriptTag()
    {
        return $this->_get(self::SCRIPT_TAG);
    }

    public function setScriptTag($scriptTag)
    {
        return $this->setData(self::SCRIPT_TAG , $scriptTag);
    }

    public function getPublicEndpoints()
    {
        return $this->_get(self::PUBLIC_ENDPOINTS);
    }

    public function setPublicEndpoints($publicEndpoints)
    {
        return $this->setData(self::PUBLIC_ENDPOINTS , $publicEndpoints);
    }
}

