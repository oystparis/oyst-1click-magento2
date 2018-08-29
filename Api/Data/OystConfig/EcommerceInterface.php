<?php

namespace Oyst\OneClick\Api\Data\OystConfig;

/**
 * Interface EcommerceInterface
 * @api
 */
interface EcommerceInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const SHIPPING_METHODS = 'shipping_methods';
    const COUNTRIES = 'countries';
    const ORDER_STATUSES = 'order_statuses';

    /**#@-*/

    /**
     * @return \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface[]|null
     */
    public function getShippingMethods();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface[] $shippingMethods
     * @return $this
     */
    public function setShippingMethods($shippingMethods);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\CountryInterface[]|null
     */
    public function getCountries();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\CountryInterface[] $countries
     * @return $this
     */
    public function setCountries($countries);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\OrderStatusInterface[]|null
     */
    public function getOrderStatuses();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\OrderStatusInterface[] $orderStatuses
     * @return $this
     */
    public function setOrderStatuses($orderStatuses);
}