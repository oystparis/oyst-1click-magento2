<?php

namespace Oyst\OneClick\Controller\Checkout;

class AddToCart extends \Magento\Checkout\Controller\Cart\Add
{
    public function execute()
    {
        $result = parent::execute();
        $this->_checkoutSession->setOystOneClickQuoteId($this->cart->getQuote()->getId());
        return $result;
    }
    
    /**
     * Resolve response
     *
     * @param string $backUrl
     * @param \Magento\Catalog\Model\Product $product
     * @return $this|\Magento\Framework\Controller\Result\Redirect
     */
    protected function goBack($backUrl = null, $product = null)
    {
        if (!$this->getRequest()->isAjax()) {
            return parent::goBack($backUrl, $product);
        }

        $jsonData = null;
        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);

        if(empty($product)) {
            $lastMessage = $this->messageManager->getMessages()->getLastAddedMessage();

            $jsonData = [
                'error' => true,
                'message' => !empty($lastMessage) ? $lastMessage->getText() : '',
            ];
        } else {
            $jsonData = ['cart_id' => $this->cart->getQuote()->getId()];
        }

        $result->setData($jsonData);
        return $result;
    }
}