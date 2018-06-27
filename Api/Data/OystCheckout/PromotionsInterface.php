<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface PromotionsInterface
 * @api
 */
interface PromotionsInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const FREE_ITEMS = 'free_items';
    const DISCOUNTS = 'discounts';
    const COUPONS = 'coupons';
    const USER_ADVANTAGES = 'user_advantages';

    /**#@-*/

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[]|null
     */
    public function getFreeItems();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[] $freeItems
     * @return $this
     */
    public function setFreeItems($freeItems);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\DiscountInterface[]|null
     */
    public function getDiscounts();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\DiscountInterface[] $discounts
     * @return $this
     */
    public function setDiscounts($discounts);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\CouponInterface[]|null
     */
    public function getCoupons();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\CouponInterface[] $coupons
     * @return $this
     */
    public function setCoupons($coupons);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesInterface[]|null
     */
    public function getUserAdvantages();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\UserAdvantagesInterface[] $userAdvantages
     * @return $this
     */
    public function setUserAdvantages($userAdvantages);
}
