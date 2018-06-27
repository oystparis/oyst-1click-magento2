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

    const ID_OYST = 'id_oyst';
    const IP = 'ip';
    const USER = 'user';
    const ITEMS = 'items';
    const PROPOSAL_ITEMS = 'proposal_items';
    const PACKAGES = 'packages';
    const PROMOTIONS = 'promotions';
    const SHIPPING = 'shipping';
    const BILLING = 'billing';
    const SHOP = 'shop';
    const MESSAGES = 'messages';
    const CHECKOUT_AGREEMENTS = 'checkout_agreements';
    const CURRENCY = 'currency';
    const TOTALS = 'totals';
    const CONTEXT = 'context';

    /**#@-*/

    /**
     * @return string
     */
    public function getIdOyst();

    /**
     * @param string $idOyst
     * @return $this
     */
    public function setIdOyst($idOyst);

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[]|null
     */
    public function getProposalItems();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[] $proposalItems
     * @return $this
     */
    public function setProposalItems($proposalItems);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[]|null
     */
    public function getPackages();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[] $packages
     * @return $this
     */
    public function setPackages($packages);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\PromotionsInterface[]|null
     */
    public function getPromotions();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\PromotionsInterface[] $promotions
     * @return $this
     */
    public function setPromotions($promotions);

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\CheckoutAgreementsInterface[]|null
     */
    public function getCheckoutAgreements();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\CheckoutAgreementsInterface[] $checkoutAgreements
     * @return $this
     */
    public function setCheckoutAgreements($checkoutAgreements);

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterface[]
     */
    public function getTotals();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\TotalsInterface[] $totals
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
    
    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Oyst\OneClick\Api\Data\OystCheckoutExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Oyst\OneClick\Api\Data\OystCheckoutExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Oyst\OneClick\Api\Data\OystCheckoutExtensionInterface $extensionAttributes
    );
}
