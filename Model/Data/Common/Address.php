<?php

namespace Oyst\OneClick\Model\Data\Common;

class Address extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\AddressInterface
{
    public function getAlias()
    {
        return $this->_get(self::ALIAS);
    }

    public function setAlias($alias)
    {
        return $this->setData(self::ALIAS , $alias);
    }

    public function getCompany()
    {
        return $this->_get(self::COMPANY);
    }

    public function setCompany($company)
    {
        return $this->setData(self::COMPANY , $company);
    }

    public function getLastname()
    {
        return $this->_get(self::LASTNAME);
    }

    public function setLastname($lastname)
    {
        return $this->setData(self::LASTNAME , $lastname);
    }

    public function getFirstname()
    {
        return $this->_get(self::FIRSTNAME);
    }

    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME , $firstname);
    }

    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL , $email);
    }

    public function getStreet1()
    {
        return $this->_get(self::STREET1);
    }

    public function setStreet1($street1)
    {
        return $this->setData(self::STREET1 , $street1);
    }

    public function getStreet2()
    {
        return $this->_get(self::STREET2);
    }

    public function setStreet2($street2)
    {
        return $this->setData(self::STREET2 , $street2);
    }

    public function getPostcode()
    {
        return $this->_get(self::POSTCODE);
    }

    public function setPostcode($postcode)
    {
        return $this->setData(self::POSTCODE , $postcode);
    }

    public function getCity()
    {
        return $this->_get(self::CITY);
    }

    public function setCity($city)
    {
        return $this->setData(self::CITY , $city);
    }
    
    public function getCountry()
    {
        return $this->_get(self::COUNTRY);
    }

    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY , $country);
    }

    public function getPhone()
    {
        return $this->_get(self::PHONE);
    }

    public function setPhone($phone)
    {
        return $this->setData(self::PHONE , $phone);
    }

    public function getPhoneMobile()
    {
        return $this->_get(self::PHONE_MOBILE);
    }

    public function setPhoneMobile($phoneMobile)
    {
        return $this->setData(self::PHONE_MOBILE , $phoneMobile);
    }

    public function getOther()
    {
        return $this->_get(self::OTHER);
    }

    public function setOther($other)
    {
        return $this->setData(self::OTHER , $other);
    }

    public function getVatNumber()
    {
        return $this->_get(self::VAT_NUMBER);
    }

    public function setVatNumber($vatNumber)
    {
        return $this->setData(self::VAT_NUMBER , $vatNumber);
    }

    public function getDni()
    {
        return $this->_get(self::DNI);
    }

    public function setDni($dni)
    {
        return $this->setData(self::DNI , $dni);
    }
}
