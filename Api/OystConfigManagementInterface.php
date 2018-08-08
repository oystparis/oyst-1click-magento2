<?php

namespace Oyst\OneClick\Api;

/**
 * @api
 */
interface OystConfigManagementInterface
{
    /**
     * @param string $scriptTag
     * @return bool
     */
    public function saveOystConfigScriptTag($scriptTag);

    /**
     * @return \Oyst\OneClick\Api\Data\OystConfigInterface
     */
    public function getOystConfig();
}