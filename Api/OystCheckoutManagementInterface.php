<?php

namespace Oyst\OneClick\Api;

/**
 * @api
 */
interface OystCheckoutManagementInterface
{
    /**
     * @param string $id
     * @return \Oyst\OneClick\Api\Data\OystCheckoutInterface
     */
    public function getOystCheckoutFromMagentoQuote($id);
    
    /**
     * @param string $oystId
     * @param \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout
     * @return \Oyst\OneClick\Api\Data\OystCheckoutInterface
     */
    public function syncMagentoQuoteWithOystCheckout($oystId, \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout);
}

