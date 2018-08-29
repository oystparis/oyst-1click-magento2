<?php

namespace Oyst\OneClick\Api;

/**
 * @api
 */
interface OystConfigManagementInterface
{
    /**
     * @param \Oyst\OneClick\Api\Data\OystConfig\OystInterface $oystConfig
     * @return bool
     */
    public function saveOystConfig(\Oyst\OneClick\Api\Data\OystConfig\OystInterface $oystConfig);

    /**
     * @return \Oyst\OneClick\Api\Data\OystConfig\EcommerceInterface
     */
    public function getEcommerceConfig();
}