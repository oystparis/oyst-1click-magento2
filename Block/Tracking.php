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
        return array(
            'version' => 1,
            'type' => 'track',
            'event' => 'Confirmation Displayed',
        );
    }

    public function getCheckoutOnepageSuccessTrackingExtraParameters()
    {
        $order = $this->orderFactory->create()->load($this->checkoutSession->getLastOrderId());
        $extraParameters = [
            'amount' => $order->getGrandTotal(),
            'paymentMethod' => $order->getPayment()->getMethod(),
            'currency' => $order->getOrderCurrencyCode(),
            'referrer' => urlencode($this->_urlBuilder->getCurrentUrl()),
            'merchantId' => $this->_scopeConfig->getValue('oyst_oneclick/general/merchant_id'),
            'orderId' => $order->getIncrementId(),
            'userEmail' => $order->getCustomerEmail(),
        ];

        if ($order->getCustomerId()) {
            $extraParameters['userId'] = $order->getCustomerId();
        }

        return $extraParameters;
    }

    public function isEnabled()
    {
        return $this->_scopeConfig->getValue('oyst_oneclick/general/enabled');
    }
}
