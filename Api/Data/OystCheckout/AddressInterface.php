<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface AddressInterface
 * @api
 */
interface AddressInterface 
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ALIAS = 'alias';
    const COMPANY = 'company';
    const LASTNAME = 'lastname';
    const FIRSTNAME = 'firstname';
    const EMAIL = 'email';
    const STREET1 = 'street1';
    const STREET2 = 'street2';
    const POSTCODE = 'postcode';
    const COUNTRY = 'country';
    const PHONE = 'phone';
    const PHONE_MOBILE = 'phone_mobile';
    const OTHER = 'other';
    const VAT_NUMBER = 'vat_number';
    const DNI = 'dni';

    /**#@-*/

    /**
     * @return string
     */
    public function getAlias();

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias);

    /**
     * @return string|null
     */
    public function getCompany();

    /**
     * @param string $company
     * @return $this
     */
    public function setCompany($company);

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname);

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getStreet1();

    /**
     * @param string $street1
     * @return $this
     */
    public function setStreet1($street1);

    /**
     * @return string|null
     */
    public function getStreet2();

    /**
     * @param string $street2
     * @return $this
     */
    public function setStreet2($street2);

    /**
     * @return string
     */
    public function getPostcode();

    /**
     * @param string $postcode
     * @return $this
     */
    public function setPostcode($postcode);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\CountryInterface
     */
    public function getCountry();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\CountryInterface $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * @return string|null
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getPhoneMobile();

    /**
     * @param string $phoneMobile
     * @return $this
     */
    public function setPhoneMobile($phoneMobile);

    /**
     * @return string|null
     */
    public function getOther();

    /**
     * @param string $other
     * @return $this
     */
    public function setOther($other);

    /**
     * @return string|null
     */
    public function getVatNumber();

    /**
     * @param string $vatNumber
     * @return $this
     */
    public function setVatNumber($vatNumber);

    /**
     * @return string|null
     */
    public function getDni();

    /**
     * @param string $dni
     * @return $this
     */
    public function setDni($dni);
}
