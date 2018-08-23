<?php

namespace Oyst\OneClick\Api;

/**
 * @api
 */
interface OystOrderManagementInterface
{
    /**
     * @param \Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder
     * @return \Oyst\OneClick\Api\Data\OystOrderInterface
     */
    public function createOrderFromOystCheckout(\Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder);
}