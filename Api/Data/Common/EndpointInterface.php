<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface EndpointInterface
 * @api
 */

interface EndpointInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const URL = 'url';
    const TYPE = 'type';

    /**#@-*/
    
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type);
    
    /**
     * @return string
     */
    public function getType();
    
    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url);
    
    /**
     * @return string
     */
    public function getUrl();
}

