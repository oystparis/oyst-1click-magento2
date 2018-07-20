<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface TotalTaxInterface
 * @api
 */
interface TotalTaxInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const AMOUNT = 'amount';
    const LABEL = 'label';
    const RATE = 'rate';

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

    /**
     * @return float
     */
    public function getRate();

    /**
     * @param float $rate
     * @return $this
     */
    public function setRate($rate);
}
