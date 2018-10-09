<?php

namespace Oyst\OneClick\Api\Data\OystOrder;

/**
 * Interface PaymentInterface
 * @api
 */
interface PaymentInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const METHOD = 'method';
    const LAST_TRANSACTION = 'last_transaction';

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
    
    /**
     * @return \Oyst\OneClick\Api\Data\Common\PaymentTransactionInterface|null
     */
    public function getLastTransaction();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\PaymentTransactionInterface $lastTransaction
     * @return $this
     */
    public function setLastTransaction($lastTransaction);
}