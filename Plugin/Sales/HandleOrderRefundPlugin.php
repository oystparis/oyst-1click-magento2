<?php

namespace Oyst\OneClick\Plugin\Sales;

class HandleOrderRefundPlugin
{
    protected $oystPaymentManagement;

    public function __construct(
        \Oyst\OneClick\Model\OystPaymentManagement $oystPaymentManagement
    )
    {
        $this->oystPaymentManagement = $oystPaymentManagement;
    }

    public function aroundSave(
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo $subject,
        \Closure $proceed,
        \Magento\Framework\Model\AbstractModel $object
    )
    {
        $result = $proceed($object);

        $order = $object->getOrder();
        $this->oystPaymentManagement->handleMagentoOrdersToRefund([$order->getId() => $object->getGrandTotal()], true);

        return $result;
    }
}