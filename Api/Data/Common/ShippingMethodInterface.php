<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface ShippingMethodInterface
 * @api
 */
interface ShippingMethodInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const REFERENCE = 'reference';
    const LABEL = 'label';
    const DELIVERY_DELAY = 'delivery_delay';
    const AMOUNT_TAX_EXCL = 'amount_tax_excl';
    const AMOUNT_TAX_INCL = 'amount_tax_incl';
    const TYPE = 'type';

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

    /**
     * @return float
     */
    public function getAmountTaxExcl();

    /**
     * @param float $amountTaxExcl
     * @return $this
     */
    public function setAmountTaxExcl($amountTaxExcl);

    /**
     * @return float
     */
    public function getAmountTaxIncl();

    /**
     * @param float $amountTaxIncl
     * @return $this
     */
    public function setAmountTaxIncl($amountTaxIncl);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $label
     * @return $this
     */
    public function setType($type);
}
