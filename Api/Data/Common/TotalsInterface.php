<?php

namespace Oyst\OneClick\Api\Data\Common;

/**
 * Interface TotalsInterface
 * @api
 */
interface TotalsInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const DETAILS_TAX_INCL = 'details_tax_incl';
    const DETAILS_TAX_EXCL = 'details_tax_excl';
    const TAXES = 'taxes';

    /**#@-*/

    /**
     * @return \Oyst\OneClick\Api\Data\Common\TotalDetailsInterface
     */
    public function getDetailsTaxIncl();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\TotalDetailsInterface $detailTaxIncl
     * @return $this
     */
    public function setDetailsTaxIncl($detailTaxIncl);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\TotalDetailsInterface
     */
    public function getDetailsTaxExcl();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\TotalDetailsInterface $detailTaxExcl
     * @return $this
     */
    public function setDetailsTaxExcl($detailTaxExcl);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\TotalTaxInterface[]
     */
    public function getTaxes();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\TotalTaxInterface[] $taxes
     * @return $this
     */
    public function setTaxes($taxes);
}
