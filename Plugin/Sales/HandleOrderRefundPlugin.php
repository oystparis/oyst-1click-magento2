<?php

namespace Oyst\OneClick\Plugin\Sales;

class HandleOrderRefundPlugin
{
    protected $oystOrderManagement;

    public function __construct(
        \Oyst\OneClick\Model\OystOrderManagement $oystOrderManagement
    )
    {
        $this->oystOrderManagement = $oystOrderManagement;
    }

    public function aroundSave(
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo $subject,
        \Closure $proceed,
        \Magento\Framework\Model\AbstractModel $object
    )
    {
        $result = $proceed($object);

        $this->oystOrderManagement->handleMagentoOrdersToRefund([$object->getOrder()->getId()], true);

        return $result;
    }
}