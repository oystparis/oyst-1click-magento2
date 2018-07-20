<?php

namespace Oyst\OneClick\Api\Data\Common;

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
     * @return \Oyst\OneClick\Api\Data\Common\AddressInterface
     */
    public function getAddress();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\AddressInterface $address
     * @return $this
     */
    public function setAddress($address);
}
