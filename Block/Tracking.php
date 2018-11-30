<?php

namespace Oyst\OneClick\Block;

class Tracking extends \Magento\Framework\View\Element\Template
{
    protected $checkoutSession;

    protected $orderFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
    }

    public function getCheckoutOnepageSuccessTrackingParameters()
    {
        $order = $this->orderFactory->create()->load($this->checkoutSession->getLastOrderId());
        return array(
            'amount' => $order->getGrandTotal(),
            'paymentMethod' => $order->getPayment()->getMethod(),
            'currency' => $order->getOrderCurrencyCode(),
            'referrer' => urlencode($this->_urlBuilder->getCurrentUrl()),
            'merchantId' => $this->_scopeConfig->getValue('oyst_oneclick/general/merchant_id'),
        );
    }

    public function isEnabled()
    {
        return $this->_scopeConfig->getValue('oyst_oneclick/general/enabled');
    }
}
