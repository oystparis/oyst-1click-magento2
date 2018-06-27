<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface BillingInterface
 * @api
 */
interface BillingInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ADDRESS = 'address';

    /**#@-*/

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\AddressInterface
     */
    public function getAddress();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\AddressInterface $address
     * @return $this
     */
    public function setAddress($address);
}
