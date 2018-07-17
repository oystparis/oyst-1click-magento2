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
}