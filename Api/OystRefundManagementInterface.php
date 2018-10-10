<?php

namespace Oyst\OneClick\Api;

/**
 * @api
 */
interface OystRefundManagementInterface
{
    /**
     * @param string $oystId
     * @param \Oyst\OneClick\Api\Data\OystRefundInterface $oystRefund
     * @return bool
     */
    public function createMagentoCreditmemo($oystId, $oystRefund);
}