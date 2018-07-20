<?php

namespace Oyst\OneClick\Model\OystOrder;

class Builder
{
    protected $oystOrderFactory;

    public function __construct(
        \Oyst\OneClick\Api\Data\OystOrderInterfaceFactory $oystOrderFactory
    )
    {
        $this->oystOrderFactory = $oystOrderFactory;
    }

     public function buildOystOrder(
        \Magento\Sales\Model\Order $order
    )
    {
        /* @var $oystOrder \Oyst\OneClick\Api\Data\OystOrderInterface */
        $oystOrder = $this->oystOrderFactory->create();

        $oystOrder->setOystId($order->getOystId());
        $oystOrder->setReference($order->getIncrementId());

        // TODO : All members

        return $oystOrder;
    }
}