<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface CarrierInterface
 * @api
 */
interface CarrierInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const REFERENCE = 'reference';
    const LABEL = 'label';
    const DELIVERY_DELAY = 'delivery_delay';

    /**#@-*/

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * @return string|null
     */
    public function getDeliveryDelay();

    /**
     * @param string $deliveryDelay
     * @return $this
     */
    public function setDeliveryDelay($deliveryDelay);
}
