<?php

namespace Oyst\OneClick\Api;

/**
 * @api
 */
interface OystOrderManagementInterface
{
    /**
     * @param string $oystId
     * @return \Oyst\OneClick\Api\Data\OystOrderInterface
     */
    public function createOrderFromOystCheckout($oystId);
}