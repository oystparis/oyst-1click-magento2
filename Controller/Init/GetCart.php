<?php

namespace Oyst\OneClick\Controller\Init;

class GetCart extends \Magento\Checkout\Controller\Cart
{
    public function execute()
    {
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);

        $result->setData(['cart_id' => $this->cart->getQuote()->getId()]);
        $this->_checkoutSession->setOystOneClickQuoteId($this->cart->getQuote()->getId());

        return $result;
    }
}