<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface UserAdvantagesInterface
 * @api
 */
interface UserAdvantagesInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const FIDELITY_POINTS = 'fidelity_points';
    const BALANCE = 'balance';

    /**#@-*/

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesFidelityPointInterface|null
     */
    public function getFidelityPoints();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesFidelityPointInterface $fidelityPoints
     * @return $this
     */
    public function setFidelityPoints($fidelityPoints);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesBalanceInterface|null
     */
    public function getBalance();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesBalanceInterface $balance
     * @return $this
     */
    public function setBalance($balance);
}
