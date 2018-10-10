<?php

namespace Oyst\OneClick\Api\Data;

/**
 * Interface OystRefundInterface
 * @api
 */
interface OystRefundInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const AMOUNT = 'amount';
    const CURRENCY = 'currency';
    const TRANSACTION_ID = 'transaction_id';

    /**#@-*/

    /**
     * @return string|null
     */
    public function getTransactionId();

    /**
     * @param string $transactionId
     * @return $this
     */
    public function setTransactionId($transactionId);

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
     * @return string|null
     */
    public function getCurrency();

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency);
}