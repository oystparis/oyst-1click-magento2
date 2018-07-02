<?php

namespace Oyst\OneClick\Api\Data;

/**
 * Interface OystCheckoutInterface
 * @api
 */
interface OystCheckoutInterface
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
    const AGREEMENTS = 'agreements';
    const CURRENCY = 'currency';
    const TOTALS = 'totals';
    const CONTEXT = 'context';

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\UserInterface
     */
    public function getUser();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\UserInterface $user
     * @return $this
     */
    public function setUser($user);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[]
     */
    public function getItems();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface $items
     * @return $this
     */
    public function setItems($items);

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

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface
     */
    public function getShipping();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface $shipping
     * @return $this
     */
    public function setShipping($shipping);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\BillingInterface
     */
    public function getBilling();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\BillingInterface $billing
     * @return $this
     */
    public function setBilling($billing);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ShopInterface
     */
    public function getShop();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ShopInterface $shop
     * @return $this
     */
    public function setShop($shop);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\MessageInterface[]|null
     */
    public function getMessages();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\MessageInterface[] $messages
     * @return $this
     */
    public function setMessages($messages);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\CheckoutAgreementInterface[]|null
     */
    public function getAgreements();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\CheckoutAgreementInterface[] $agreements
     * @return $this
     */
    public function setAgreements($agreements);

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterface
     */
    public function getTotals();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterface $totals
     * @return $this
     */
    public function setTotals($totals);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\KeyValueInterface[]|null
     */
    public function getContext();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\KeyValueInterface[] $context
     * @return $this
     */
    public function setContext($context);
}
