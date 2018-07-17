<?php

namespace Oyst\OneClick\Model\Data\OystCheckout;

class CheckoutAgreement extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckout\CheckoutAgreementInterface
{
    public function getAcceptanceMessage()
    {
        return $this->_get(self::ACCEPTANCE_MESSAGE);
    }

    public function setAcceptanceMessage($acceptanceMessage)
    {
        return $this->setData(self::ACCEPTANCE_MESSAGE , $acceptanceMessage);
    }

    public function getFullAgreements()
    {
        return $this->_get(self::FULL_AGREEMENTS);
    }

    public function setFullAgreements($fullAgreements)
    {
        return $this->setData(self::FULL_AGREEMENTS , $fullAgreements);
    }
}
