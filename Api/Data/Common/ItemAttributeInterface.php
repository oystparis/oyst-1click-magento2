<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface ItemAttributeInterface
 * @api
 */
interface ItemAttributeInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const CODE = 'code';
    const LABEL = 'label';
    const VALUE = 'value';

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
    public function getValue();

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value);
}
