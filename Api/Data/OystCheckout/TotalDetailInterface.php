<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface TotalDetailInterface
 * @api
 */
interface TotalDetailsInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const TOTAL_ITEMS = 'total_items';
    const TOTAL_SHIPPING = 'total_shipping';
    const TOTAL_DISCOUNT = 'total_discount';
    const TOTAL = 'total';

    /**#@-*/

    /**
     * @return float
     */
    public function getTotalItems();

    /**
     * @param float $totalItems
     * @return $this
     */
    public function setTotalItems($totalItems);

    /**
     * @return float
     */
    public function getTotalShipping();

    /**
     * @param float $totalShipping
     * @return $this
     */
    public function setTotalShipping($totalShipping);

    /**
     * @return float
     */
    public function getTotalDiscount();

    /**
     * @param float $totalDiscount
     * @return $this
     */
    public function setTotalDiscount($totalDiscount);

    /**
     * @return float
     */
    public function getTotal();

    /**
     * @param float $total
     * @return $this
     */
    public function setTotal($total);
}
