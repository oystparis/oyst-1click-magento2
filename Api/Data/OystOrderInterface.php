<?php

namespace Oyst\OneClick\Api\Data;

/**
 * Interface OystOrderInterface
 * @api
 */
interface OystOrderInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const OYST_ID = 'oyst_id';
    const INTERNAL_ID = 'internal_id';
    const IP = 'ip';
    const USER = 'user';
    const ITEMS = 'items';
    const DISCOUNTS = 'discounts';
    const COUPONS = 'coupons';
    const USER_ADVANTAGES = 'user_advantages';
    const SHIPPING = 'shipping';
    const BILLING = 'billing';
    const SHOP = 'shop';
    const MESSAGES = 'messages';
    const CURRENCY = 'currency';
    const TOTALS = 'totals';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**#@-*/

    /**
     * @return string|null
     */
    public function getOystId();

    /**
     * @param string $oystId
     * @return $this
     */
    public function setOystId($oystId);

    /**
     * @return string
     */
    public function getInternalId();

    /**
     * @param string $internalId
     * @return $this
     */
    public function setInternalId($internalId);

    /**
     * @return string
     */
    public function getIp();

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp($ip);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\UserInterface
     */
    public function getUser();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\UserInterface $user
     * @return $this
     */
    public function setUser($user);

    /**
     * @return \Oyst\OneClick\Api\Data\OystOrder\ItemInterface[]
     */
    public function getItems();

    /**
     * @param \Oyst\OneClick\Api\Data\OystOrder\ItemInterface[] $items
     * @return $this
     */
    public function setItems($items);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\DiscountInterface[]|null
     */
    public function getDiscounts();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\DiscountInterface[] $discounts
     * @return $this
     */
    public function setDiscounts($discounts);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\CouponInterface[]|null
     */
    public function getCoupons();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\CouponInterface[] $coupons
     * @return $this
     */
    public function setCoupons($coupons);

    /**
     * @return \Oyst\OneClick\Api\Data\OystOrder\UserAdvantagesInterface[]|null
     */
    public function getUserAdvantages();

    /**
     * @param \Oyst\OneClick\Api\Data\OystOrder\UserAdvantagesInterface[] $userAdvantages
     * @return $this
     */
    public function setUserAdvantages($userAdvantages);

    /**
     * @return \Oyst\OneClick\Api\Data\OystOrder\ShippingInterface
     */
    public function getShipping();

    /**
     * @param \Oyst\OneClick\Api\Data\OystOrder\ShippingInterface $shipping
     * @return $this
     */
    public function setShipping($shipping);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\BillingInterface
     */
    public function getBilling();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\BillingInterface $billing
     * @return $this
     */
    public function setBilling($billing);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\ShopInterface
     */
    public function getShop();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\ShopInterface $shop
     * @return $this
     */
    public function setShop($shop);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\MessageInterface[]|null
     */
    public function getMessages();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\MessageInterface[] $messages
     * @return $this
     */
    public function setMessages($messages);

    /**
     * @return string
     */
    public function getCurrency();

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\TotalsInterface
     */
    public function getTotals();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\TotalsInterface $totals
     * @return $this
     */
    public function setTotals($totals);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\OrderStatusInterface
     */
    public function getStatus();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\OrderInterface $orderStatus
     * @return $this
     */
    public function setStatus($orderStatus);
}
