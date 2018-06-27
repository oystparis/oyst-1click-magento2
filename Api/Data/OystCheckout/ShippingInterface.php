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
    const CARRIERS_AVAILABLE = 'carriers_available';
    const CARRIER_USED = 'carrier_used';

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\CarrierInterface|null
     */
    public function getCarriersAvailable();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\CarrierInterface $carriersAvailable
     * @return $this
     */
    public function setCarriersAvailable($carriersAvailable);
    
    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\CarrierInterface
     */
    public function getCarrierUsed();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\CarrierInterface $carrierUsed
     * @return $this
     */
    public function setCarrierUsed($carrierUsed);
}
