<?php

namespace Hpayments;

use Exception;

/**
 * Class Transaction
 * @package Hpayments
 */
class Transaction extends PaymentModel
{
    protected $amount;
    protected $currency;
    protected $description;
    protected $invoice_number;
    protected $three_d_secure;
    protected $legal_document;
    protected $vat_percent;
    protected $vat_amount;
    protected $meta_data;

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
        return $this->invoice_number;
    }

    /**
     * @param mixed $invoice_number
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->invoice_number = $invoice_number;
    }

    /**
     * @return mixed
     */
    public function getThreeDsecure()
    {
        return $this->three_d_secure;
    }

    /**
     * @param mixed $three_d_secure
     */
    public function setThreeDsecure($three_d_secure)
    {
        $this->three_d_secure = $three_d_secure;
    }

    /**
     * @return mixed
     */
    public function getLegalDocument()
    {
        return $this->legal_document;
    }

    /**
     * @param mixed $legal_document
     */
    public function setLegalDocument($legal_document)
    {
        $this->legal_document = $legal_document;
    }

    /**
     * @return mixed
     */
    public function getVatPercent()
    {
        return $this->vat_percent;
    }

    /**
     * @param mixed $vat_percent
     */
    public function setVatPercent($vat_percent)
    {
        $this->vat_percent = $vat_percent;
    }

    /**
     * @return mixed
     */
    public function getVatAmount()
    {
        return $this->vat_amount;
    }

    /**
     * @param mixed $vat_amount
     */
    public function setVatAmount($vat_amount)
    {
        $this->vat_amount = $vat_amount;
    }

    /**
     * @return mixed
     */
    public function getMetaData()
    {
        return $this->meta_data;
    }

    /**
     * @param mixed $meta_data
     */
    public function setMetaData($meta_data)
    {
        $this->meta_data = $meta_data;
    }
}