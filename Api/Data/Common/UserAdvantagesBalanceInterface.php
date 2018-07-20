<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface UserAdvantagesBalanceInterface
 * @api
 */
interface UserAdvantagesBalanceInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const AMOUNT = 'amount';
    const LABEL = 'label';

    /**#@-*/

    /**
     * @return float
     */
    public function getAmount();

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount);

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
