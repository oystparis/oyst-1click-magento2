<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface PaymentInterface
 * @api
 */
interface PaymentInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const METHOD = 'method';

    /**#@-*/
    
    /**
     * @return string|null
     */
    public function getMethod();

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod($method);
}