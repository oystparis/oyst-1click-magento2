<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface ItemAttributeInterface
 * @api
 */
interface CheckoutAgreementInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ACCEPTANCE_MESSAGE = 'acceptance_message';
    const FULL_AGREEMENTS = 'full_agreements';

    /**#@-*/

    /**
     * @return string
     */
    public function getAcceptanceMessage();

    /**
     * @param string $acceptanceMessage
     * @return $this
     */
    public function setAcceptanceMessage($acceptanceMessage);

    /**
     * @return string
     */
    public function getFullAgreements();

    /**
     * @param string $fullAgreements
     * @return $this
     */
    public function setFullAgreements($fullAgreements);
}
