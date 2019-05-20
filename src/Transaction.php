<?php

namespace Hpayments;

use Exception;

/**
 * Class Transaction
 * @package Hpayments
 */
class Transaction extends PaymentModel implements \JsonSerializable
{
    protected $amount;
    protected $currency;
    protected $description;
    protected $invoiceNumber;
    protected $threeDSecure;
    protected $legalDocument;
    protected $vatPercent;
    protected $vatAmount;
    protected $metaData;

    /**
     * Payer constructor.
     * @param $data
     * @throws
     */
    public function __construct($data)
    {
        if (!isset($data['amount']) && empty($data['amount'])){
            throw new Exception('Amount is not set.');
        }

        if (!isset($data['currency']) && empty($data['currency'])){
            throw new Exception('Currency is not set.');
        }

        if (!isset($data['description']) && empty($data['description'])){
            throw new Exception('Description is not set.');
        }

        if (!isset($data['invoice_number']) && empty($data['invoice_number'])){
            throw new Exception('Invoice number is not set.');
        }

        if (!isset($data['three_d_secure']) && empty($data['three_d_secure'])){
            throw new Exception('3DS is not set.');
        }

        $this->setDataFromArray($data);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param mixed $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return mixed
     */
    public function getThreeDSecure()
    {
        return $this->threeDSecure;
    }

    /**
     * @param mixed $threeDSecure
     */
    public function setThreeDSecure($threeDSecure)
    {
        $this->threeDSecure = $threeDSecure;
    }

    /**
     * @return mixed
     */
    public function getLegalDocument()
    {
        return $this->legalDocument;
    }

    /**
     * @param mixed $legalDocument
     */
    public function setLegalDocument($legalDocument)
    {
        $this->legalDocument = $legalDocument;
    }

    /**
     * @return mixed
     */
    public function getVatPercent()
    {
        return $this->vatPercent;
    }

    /**
     * @param mixed $vatPercent
     */
    public function setVatPercent($vatPercent)
    {
        $this->vatPercent = $vatPercent;
    }

    /**
     * @return mixed
     */
    public function getVatAmount()
    {
        return $this->vatAmount;
    }

    /**
     * @param mixed $vatAmount
     */
    public function setVatAmount($vatAmount)
    {
        $this->vatAmount = $vatAmount;
    }

    /**
     * @return mixed
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * @param mixed $metaData
     */
    public function setMetaData($metaData)
    {
        $this->metaData = $metaData;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}