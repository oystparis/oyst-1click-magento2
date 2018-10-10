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
        if ($object->getGrandTotal() ==  $order->getGrandTotal()) {
            $this->oystPaymentManagement->handleMagentoOrdersToRefund([$order->getId()], true);
        } else {
            $order->addStatusHistoryComment(
                __('Partial Refund %1 %2 should be handled from Oyst Back Office.', $order->getGrandTotal(), $order->getOrderCurrencyCode())
            );
        }

        return $result;
    }
}