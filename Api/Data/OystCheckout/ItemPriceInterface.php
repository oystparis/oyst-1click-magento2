<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface ItemPriceInterface
 * @api
 */
interface ItemPriceInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const TAX_EXCL = 'tax_excl';
    const TAX_INCL = 'tax_incl';
    const WITHOUT_DISCOUNT_TAX_EXCL = 'without_discount_tax_excl';
    const WITHOUT_DISCOUNT_TAX_INCL = 'without_discount_tax_incl';
    const TOTAL_TAX_EXCL = 'total_tax_excl';
    const TOTAL_TAX_INCL = 'total_tax_incl';
    const DISCOUNT_TAX_INCL = 'discount_tax_incl';

    /**#@-*/

    /**
     * @return float
     */
    public function getTaxExcl();

    /**
     * @param float $taxExcl
     * @return $this
     */
    public function setTaxExcl($taxExcl);

    /**
     * @return float
     */
    public function getTaxIncl();

    /**
     * @param float $taxIncl
     * @return $this
     */
    public function setTaxIncl($taxIncl);

    /**
     * @return float
     */
    public function getWithoutDiscountTaxExcl();

    /**
     * @param float $withoutDiscountTaxExcl
     * @return $this
     */
    public function setWithoutDiscountTaxExcl($withoutDiscountTaxExcl);

    /**
     * @return float
     */
    public function getWithoutDiscountTaxIncl();

    /**
     * @param float $withoutDiscountTaxIncl
     * @return $this
     */
    public function setWithoutDiscountTaxIncl($withoutDiscountTaxIncl);

    /**
     * @return string
     */
    public function getTotalTaxExcl();

    /**
     * @param float $totalTaxExcl
     * @return $this
     */
    public function setTotalTaxExcl($totalTaxExcl);

    /**
     * @return float
     */
    public function getTotalTaxIncl();

    /**
     * @param float $totalTaxIncl
     * @return $this
     */
    public function setTotalTaxIncl($totalTaxIncl);

    /**
     * @return float
     */
    public function getDiscountTaxIncl();

    /**
     * @param float $discountTaxIncl
     * @return $this
     */
    public function setDiscountTaxIncl($discountTaxIncl);    
}
