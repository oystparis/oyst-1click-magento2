<?php

namespace Oyst\OneClick\Plugin\Sales;

class HandleOrderToCapturePlugin
{
    protected $oystOrderManagement;

    public function __construct(
        \Oyst\OneClick\Model\OystOrderManagement $oystOrderManagement
    )
    {
        $this->oystOrderManagement = $oystOrderManagement;
    }

    public function aroundSave(
        \Magento\Sales\Model\ResourceModel\Order $subject,
        \Closure $proceed,
        \Magento\Framework\Model\AbstractModel $object
    )
    {
        $result = $proceed($object);

        if ($object instanceof \Magento\Sales\Model\Order
         && $object->getStatus() == \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_TO_CAPTURE) {
            $this->oystOrderManagement->handleMagentoOrdersToCapture([$object->getId()]);
        }

        return $result;
    }
}