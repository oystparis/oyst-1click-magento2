<?php

namespace Oyst\OneClick\Api\Data\OystOrder;

/**
 * Interface StatusInterface
 * @api
 */
interface StatusInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const CODE = 'code';
    const LABEL = 'label';

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
}
