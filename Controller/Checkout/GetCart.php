<?php

namespace Oyst\OneClick\Controller\Checkout;

class GetCart extends \Magento\Checkout\Controller\Cart
{
    public function execute()
    {
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);

        $jsonData = ['cart_id' => $this->cart->getQuote()->getId()];

        if ($this->cart->getQuote()->getHasError()) {
            $jsonData['error'] = true;
            foreach ($this->cart->getQuote()->getErrors() as $error) {
                $errorMessages[] = $error->getCode();
            }
            $jsonData['message'] = implode('\n', $errorMessages);
        }

        $result->setData($jsonData);
        $this->_checkoutSession->setOystOneClickQuoteId($this->cart->getQuote()->getId());

        return $result;
    }
}