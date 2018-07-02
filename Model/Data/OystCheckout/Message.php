<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class Message extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\MessageInterface
{
    public function getType()
    {
        return $this->_get(self::TYPE);
    }

    public function setType($type)
    {
        return $this->setData(self::TYPE , $type);
    }

    public function getContent()
    {
        return $this->_get(self::CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT , $content);
    }
}
