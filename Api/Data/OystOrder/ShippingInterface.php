<?php

namespace Oyst\OneClick\Api\Data\OystOrder;

/**
 * Interface ShippingInterface
 * @api
 */
interface ShippingInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ADDRESS = 'address';
    const METHOD_APPLIED = 'method_applied';

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
    
    /**
     * @return \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface
     */
    public function getMethodApplied();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\ShippingMethodInterface $methodApplied
     * @return $this
     */
    public function setMethodApplied($methodApplied);
}
