<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface UserInterface
 * @api
 */
interface UserInterface 
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const ID_OYST = 'id_oyst';
    const LASTNAME = 'lastname';
    const FIRSTNAME = 'firstname';
    const EMAIL = 'email';
    const GENDER = 'gender';
    const NEWSLETTER = 'newsletter';
    const BIRTHDAY = 'birthday';
    const SIRET = 'siret';
    const APE = 'ape';
    const PHONE_MOBILE = 'phone_mobile';

    /**#@-*/

    /**
     * @return string
     */
    public function getIdOyst();

    /**
     * @param string $idOyst
     * @return $this
     */
    public function setIdOyst($idOyst);

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
     * @return string|null
     */
    public function getGender();

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender($gender);

    /**
     * @return string
     */
    public function getNewsletter();

    /**
     * @param string $newsletter
     * @return $this
     */
    public function setNewsletter($newsletter);

    /**
     * @return string|null
     */
    public function getBirthday();

    /**
     * @param string $birthday
     * @return $this
     */
    public function setBirthday($birthday);

    /**
     * @return string|null
     */
    public function getSiret();

    /**
     * @param string $siret
     * @return $this
     */
    public function setSiret($siret);

    /**
     * @return string|null
     */
    public function getApe();

    /**
     * @param string $ape
     * @return $this
     */
    public function setApe($ape);

    /**
     * @return string
     */
    public function getPhoneMobile();

    /**
     * @param string $phoneMobile
     * @return $this
     */
    public function setPhoneMobile($phoneMobile);
}
