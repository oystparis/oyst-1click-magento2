<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface PaymentTransactionInterface
 * @api
 */
interface PaymentTransactionInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ID = 'id';
    const AMOUNT = 'amount';
    const CURRENCY = 'currency';

    /**#@-*/

    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id);

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
    public function getCurrency();

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency);
}
