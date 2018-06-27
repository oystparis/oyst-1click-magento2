<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface ShopInterface
 * @api
 */
interface ShopInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const CODE = 'code';
    const LABEL = 'label';
    const URL = 'url';

    /**#@-*/

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $label
     * @return $this
     */
    public function setUrl($url);
}
