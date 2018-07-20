<?php

namespace Oyst\OneClick\Model\Data;

class OystOrder extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystOrderInterface
{
    public function getOystId()
    {
        return $this->_get(self::OYST_ID);
    }

    public function setOystId($oystId)
    {
        return $this->setData(self::OYST_ID , $oystId);
    }

    public function getReference()
    {
        return $this->_get(self::REFERENCE);
    }

    public function setReference($reference)
    {
        return $this->setData(self::REFERENCE , $reference);
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

    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS , $status);
    }

    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT , $createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT , $updatedAt);
    }
}