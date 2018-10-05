<?php

namespace Oyst\OneClick\Model\Data;

class OystCheckout extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystCheckoutInterface
{
    public function getOystId()
    {
        return $this->_get(self::OYST_ID);
    }

    public function setOystId($oystId)
    {
        return $this->setData(self::OYST_ID , $oystId);
    }

    public function getInternalId()
    {
        return $this->_get(self::INTERNAL_ID);
    }

    public function setInternalId($internalId)
    {
        return $this->setData(self::INTERNAL_ID , $internalId);
    }

    public function getIp()
    {
        return $this->_get(self::IP);
    }

    public function setIp($ip)
    {
        return $this->setData(self::IP , $ip);
    }

    public function getUser()
    {
        return $this->_get(self::USER);
    }

    public function setUser($user)
    {
        return $this->setData(self::USER , $user);
    }

    public function getItems()
    {
        return $this->_get(self::ITEMS);
    }

    public function setItems($items)
    {
        return $this->setData(self::ITEMS , $items);
    }

    public function getDiscounts()
    {
        return $this->_get(self::DISCOUNTS);
    }

    public function setDiscounts($discounts)
    {
        return $this->setData(self::DISCOUNTS , $discounts);
    }

    public function getCoupons()
    {
        return $this->_get(self::COUPONS);
    }

    public function setCoupons($coupons)
    {
        return $this->setData(self::COUPONS , $coupons);
    }

    public function getUserAdvantages()
    {
        return $this->_get(self::USER_ADVANTAGES);
    }

    public function setUserAdvantages($userAdvantages)
    {
        return $this->setData(self::USER_ADVANTAGES , $userAdvantages);
    }

    public function getShipping()
    {
        return $this->_get(self::SHIPPING);
    }

    public function setShipping($shipping)
    {
        return $this->setData(self::SHIPPING , $shipping);
    }

    public function getBilling()
    {
        return $this->_get(self::BILLING);
    }

    public function setBilling($billing)
    {
        return $this->setData(self::BILLING , $billing);
    }

    public function getPayment()
    {
        return $this->_get(self::PAYMENT);
    }

    public function setPayment($payment)
    {
        return $this->setData(self::PAYMENT , $payment);
    }

    public function getShop()
    {
        return $this->_get(self::SHOP);
    }

    public function setShop($shop)
    {
        return $this->setData(self::SHOP , $shop);
    }

    public function getMessages()
    {
        return $this->_get(self::MESSAGES);
    }

    public function setMessages($messages)
    {
        return $this->setData(self::MESSAGES , $messages);
    }

    public function getAgreements()
    {
        return $this->_get(self::AGREEMENTS);
    }

    public function setAgreements($agreements)
    {
        return $this->setData(self::AGREEMENTS , $agreements);
    }

    public function getCurrency()
    {
        return $this->_get(self::CURRENCY);
    }

    public function setCurrency($currency)
    {
        return $this->setData(self::CURRENCY , $currency);
    }

    public function getTotals()
    {
        return $this->_get(self::TOTALS);
    }

    public function setTotals($totals)
    {
        return $this->setData(self::TOTALS , $totals);
    }

    public function getAdditionalData()
    {
        return $this->_get(self::ADDITIONAL_DATA);
    }

    public function setAdditionalData($additionalData)
    {
        return $this->setData(self::ADDITIONAL_DATA , $additionalData);
    }
}
