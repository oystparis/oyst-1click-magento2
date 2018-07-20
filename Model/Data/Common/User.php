<?php

namespace Oyst\OneClick\Model\Data\Common;

class User extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\Common\UserInterface
{
    public function getOystId()
    {
        return $this->_get(self::OYST_ID);
    }

    public function setOystId($oystId)
    {
        return $this->setData(self::OYST_ID , $oystId);
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

    public function getGender()
    {
        return $this->_get(self::GENDER);
    }

    public function setGender($gender)
    {
        return $this->setData(self::GENDER , $gender);
    }

    public function getNewsletter()
    {
        return $this->_get(self::NEWSLETTER);
    }

    public function setNewsletter($newsletter)
    {
        return $this->setData(self::NEWSLETTER , $newsletter);
    }

    public function getBirthday()
    {
        return $this->_get(self::BIRTHDAY);
    }

    public function setBirthday($birthday)
    {
        return $this->setData(self::BIRTHDAY , $birthday);
    }

    public function getSiret()
    {
        return $this->_get(self::SIRET);
    }

    public function setSiret($siret)
    {
        return $this->setData(self::SIRET , $siret);
    }

    public function getApe()
    {
        return $this->_get(self::APE);
    }

    public function setApe($ape)
    {
        return $this->setData(self::APE , $ape);
    }

    public function getPhoneMobile()
    {
        return $this->_get(self::PHONE_MOBILE);
    }

    public function setPhoneMobile($phoneMobile)
    {
        return $this->setData(self::PHONE_MOBILE , $phoneMobile);
    }
}
