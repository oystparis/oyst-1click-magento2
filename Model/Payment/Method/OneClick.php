<?php

namespace Oyst\OneClick\Model\Payment\Method;

class OneClick extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_OYST_ONECLICK_CODE = 'oyst_oneclick';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_OYST_ONECLICK_CODE;

    protected $_canRefund = true;

    protected $_canRefundInvoicePartial = true;

    public function isActive($storeId = null)
    {
        $path = 'oyst_oneclick/general/enabled';
        $result = $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
        return (bool)(int)$result;
    }
}