<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

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
    const METHODS_AVAILABLE = 'methods_available';
    const METHOD_USED = 'method_used';

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
    
    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ShippingMethodInterface[]|null
     */
    public function getMethodsAvailable();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ShippingMethodInterface[] $methodsAvailable
     * @return $this
     */
    public function setMethodsAvailable($methodsAvailable);
    
    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ShippingMethodInterface
     */
    public function getMethodUsed();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ShippingMethodInterface $methodUsed
     * @return $this
     */
    public function setMethodUsed($methodUsed);
}
