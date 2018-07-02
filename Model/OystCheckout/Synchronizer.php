<?php

namespace Oyst\OneClick\Model\OystCheckout;

class Synchronizer
{
    public function syncMagentoQuote(
        \Magento\Quote\Model\Quote $quote,
        \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout
    )
    {
        
    }
    
    protected function syncItems(
        \Magento\Quote\Model\Quote $quote,
        \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout
    )
    {
        
    }
    
    protected function syncCustomer()
    {
        
    }
    
    protected function syncCoupons()
    {
        
    }
    
    protected function syncAddresses()
    {
        
    }
    
    protected function syncShippingMethod()
    {
        
    }
}

