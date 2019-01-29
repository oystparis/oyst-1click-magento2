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

    protected $oystPaymentManagement;

    public function __construct(
        \Oyst\OneClick\Model\OystPaymentManagement $oystPaymentManagement,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        \Magento\Directory\Helper\Data $directory = null
    ) {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $resource,
            $resourceCollection,
            $data,
            $directory
        );
        $this->oystPaymentManagement = $oystPaymentManagement;
    }

    public function isActive($storeId = null)
    {
        $path = 'oyst_oneclick/general/enabled';
        $result = $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
        return (bool)(int)$result;
    }

    public function refund(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        $creditmemo = $payment->getCreditmemo();
        $order = $payment->getOrder();
        $this->oystPaymentManagement->handleMagentoOrdersToRefund(
            [$order->getId() => $creditmemo->getBaseGrandTotal()], true
        );

        return $this;
    }
}