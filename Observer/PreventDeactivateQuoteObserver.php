<?php

namespace Oyst\OneClick\Observer;

use Magento\Framework\Event\ObserverInterface;

class PreventDeactivateQuoteObserver implements ObserverInterface
{
    /**
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        $quote->setIsActive(true);
        $quote->preventSaving();

        return $this;
    }
}