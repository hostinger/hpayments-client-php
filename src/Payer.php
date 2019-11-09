<?php

namespace Hpayments;

use Exception;

/**
 * Class Payer
 * @package Hpayments
 */
class Payer extends PaymentModel
{
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $country_code;
    protected $zip;
    protected $city;
    protected $address;
    protected $custom_account_id;
    protected $document_required;

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
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param string $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
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
        return $this->custom_account_id;
    }

    /**
     * @param mixed $custom_account_id
     */
    public function setCustomAccountId($custom_account_id)
    {
        $this->custom_account_id = $custom_account_id;
    }

    /**
     * @return string
     */
    public function getDocumentRequired()
    {
        return $this->document_required;
    }

    /**
     * @param $document_required
     */
    public function setDocumentRequired($document_required)
    {
        $this->document_required = $document_required;
    }
}