<?php

namespace Oyst\OneClick\Observer;

use Magento\Framework\Event\ObserverInterface;

class SetOystFieldsToOrderObserver implements ObserverInterface
{
    /**
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        $order->setOystId($quote->getOystId());

        return $this;
    }
}