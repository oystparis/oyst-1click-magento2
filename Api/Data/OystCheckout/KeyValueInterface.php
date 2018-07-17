<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface KeyValueInterface
 * @api
 */
interface KeyValueInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const KEY = 'key';
    const VALUE = 'value';

    /**#@-*/

    /**
     * @return string
     */
    public function getKey();

    /**
     * @param string $key
     * @return $this
     */
    public function setKey($key);

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value);
}
