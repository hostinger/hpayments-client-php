<?php

namespace Hpayments;

use Exception;

/**
 * Class Payer
 * @package Hpayments
 */
class Payer extends PaymentModel implements \JsonSerializable
{
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $countryCode;
    protected $zip;
    protected $city;
    protected $address;
    protected $customAccountId;

    /**
     * Payer constructor.
     * @param $data
     * @throws
     */
    public function __construct($data)
    {
        if (!isset($data['email']) && empty($data['email'])) {
            throw new Exception('Email is not set.');
        }

        if (!isset($data['custom_account_id']) && empty($data['custom_account_id'])) {
            throw new Exception('Custom Account ID is not set.');
        }

        $this->setDataFromArray($data);
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCustomAccountId()
    {
        return $this->customAccountId;
    }

    /**
     * @param mixed $customAccountId
     */
    public function setCustomAccountId($customAccountId)
    {
        $this->customAccountId = $customAccountId;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}