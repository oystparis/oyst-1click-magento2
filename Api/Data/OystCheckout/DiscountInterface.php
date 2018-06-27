<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface DiscountInterface
 * @api
 */
interface DiscountInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ID = 'id';
    const LABEL = 'label';
    const AMOUNT_TAX_EXCL = 'amount_tax_excl';
    const AMOUNT_TAX_INCL = 'amount_tax_incl';

    /**#@-*/

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

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
}