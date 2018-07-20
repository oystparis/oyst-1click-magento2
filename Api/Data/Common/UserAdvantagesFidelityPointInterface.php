<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface UserAdvantagesFidelityPointInterface
 * @api
 */
interface UserAdvantagesFidelityPointInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const QUANTITY = 'quantity';
    const LABEL = 'label';

    /**#@-*/

    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity($quantity);

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
