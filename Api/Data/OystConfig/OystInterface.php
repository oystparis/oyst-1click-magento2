<?php

namespace Oyst\OneClick\Api\Data\OystConfig;

/**
 * Interface OystInterface
 * @api
 */
interface OystInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const MERCHANT_ID = 'merchant_id';
    const SCRIPT_TAG = 'script_tag';
    const PUBLIC_ENDPOINTS = 'public_endpoints';

    /**#@-*/

    /**
     * @return string|null
     */
    public function getMerchantId();

    /**
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId);

    /**
     * @return string|null
     */
    public function getScriptTag();

    /**
     * @param string $scriptTag
     * @return $this
     */
    public function setScriptTag($scriptTag);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\EndpointInterface[]|null
     */
    public function getPublicEndpoints();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\EndpointInterface[] $publicEndpoints
     * @return $this
     */
    public function setPublicEndpoints($publicEndpoints);
}