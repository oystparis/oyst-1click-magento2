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
    const ENDPOINTS = 'endpoints';

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
    public function getEndpoints();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\EndpointInterface[] $endpoints
     * @return $this
     */
    public function setEndpoints($endpoints);
}