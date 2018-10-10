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
    public function createMagentoOrderFromOystOrder(\Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder);
    
    /**
     * @return \Oyst\OneClick\Api\Data\OystOrderInterface
     */
    public function getOystOrderFromMagentoOrder($oystId);
    
    /**
     * @param string $oystId
     * @param string $oystApiStatus
     * @param \Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder
     * @return \Oyst\OneClick\Api\Data\OystOrderInterface
     */
    public function syncMagentoOrderWithOystOrderStatus($oystId, \Oyst\OneClick\Api\Data\OystOrderInterface $oystOrder);
}