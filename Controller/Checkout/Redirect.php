<?php

namespace Oyst\OneClick\Controller\Checkout;

class Redirect extends \Magento\Framework\App\Action\Action
{
    protected $checkoutSession;
    
    protected $orderFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\OrderFactory $orderFactory
    )
    {
        parent::__construct($context);
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
    }
    
    public function execute()
    {
        $quoteId = $this->checkoutSession->getOystOneClickQuoteId(true);
        $order = $this->orderFactory->create()->load($quoteId, 'quote_id');
        
        $this->checkoutSession->setLastQuoteId($quoteId);
        $this->checkoutSession->setLastSuccessQuoteId($quoteId);
        $this->checkoutSession->setLastOrderId($order->getId());
        $this->checkoutSession->setLastRealOrderId($order->getIncrementId());
        $this->checkoutSession->setLastOrderStatus($order->getStatus());
        
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('checkout/onepage/success');
        return $resultRedirect;
    }
}