<?php

namespace Oyst\OneClick\Api\Data\OystOrder;

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
    const BALANCE_USED = 'balance_used';

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
}
