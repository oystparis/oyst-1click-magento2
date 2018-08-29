<?php

namespace Oyst\OneClick\Model\Data\Common;

class Endpoint extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\EndpointInterface
{
    public function getUrl()
    {
        return $this->_get(self::URL);
    }

    public function setUrl($url)
    {
        return $this->setData(self::URL , $url);
    }

    public function getType()
    {
        return $this->_get(self::TYPE);
    }

    public function setType($type)
    {
        return $this->setData(self::TYPE , $type);
    }
}
