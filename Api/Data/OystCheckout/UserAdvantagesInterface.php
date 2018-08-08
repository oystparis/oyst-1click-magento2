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

    const FIDELITY_POINTS_USED = 'fidelity_points_used';
    const FIDELITY_POINTS_AVAILABLE = 'fidelity_points_available';
    const BALANCE_USED = 'balance_used';
    const BALANCE_AVAILABLE = 'balance_available';

    /**#@-*/

    /**
     * @return \Oyst\OneClick\Api\Data\Common\UserAdvantagesFidelityPointInterface|null
     */
    public function getFidelityPointsUsed();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\UserAdvantagesFidelityPointInterface $fidelityPointsUsed
     * @return $this
     */
    public function setFidelityPointsUsed($fidelityPointsUsed);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\UserAdvantagesBalanceInterface|null
     */
    public function getBalanceUsed();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\UserAdvantagesBalanceInterface $balanceUsed
     * @return $this
     */
    public function setBalanceUsed($balanceUsed);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\UserAdvantagesBalanceInterface|null
     */
    public function getBalanceAvailable();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\UserAdvantagesBalanceInterface $balanceAvailable
     * @return $this
     */
    public function setBalanceAvailable($balanceAvailable);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\UserAdvantagesFidelityPointInterface|null
     */
    public function getFidelityPointsAvailable();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\UserAdvantagesFidelityPointInterface $fidelityPointsAvailable
     * @return $this
     */
    public function setFidelityPointsAvailable($fidelityPointsAvailable);
}
