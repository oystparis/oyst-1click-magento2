<?php

namespace Oyst\OneClick\Plugin\Quote;

class PreventAutoSendOrderEmailPlugin
{
    public function aroundExecute(
        \Magento\Quote\Observer\Webapi\SubmitObserver $subject,
        \Closure $proceed,
        \Magento\Framework\Event\Observer $observer
    )
    {
        /** @var  \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();

        if ($order->getPayment()->getMethod() == \Oyst\OneClick\Model\Payment\Method\OneClick::PAYMENT_METHOD_OYST_ONECLICK_CODE ) {
            $order->setCanSendNewEmailFlag(false);
        }

        return $proceed($observer);
    }
}