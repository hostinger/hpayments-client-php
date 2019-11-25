<?php

namespace Hpayments;

use Exception;

/**
 * Class RecurrentTransaction
 * @package Hpayments
 */
class RecurrentTransaction extends PaymentModel
{
    protected $amount;
    protected $currency;
    protected $invoice_number;
    protected $method_id;
    protected $meta_data;

    /**
     * Payer constructor.
     * @param $data
     * @throws
     */
    public function __construct(array $data)
    {
        if (!isset($data['amount']) && empty($data['amount'])){
            throw new Exception('Amount is not set.');
        }

        if (!isset($data['currency']) && empty($data['currency'])){
            throw new Exception('Currency is not set.');
        }

        if (!isset($data['invoice_number']) && empty($data['invoice_number'])){
            throw new Exception('Invoice number is not set.');
        }

        if (!isset($data['method_id']) && empty($data['method_id'])){
            throw new Exception('Method ID is not set.');
        }

        $this->setDataFromArray($data);
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoice_number;
    }

    /**
     * @param string $invoice_number
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->invoice_number = $invoice_number;
    }

    /**
     * @return int
     */
    public function getMethodId()
    {
        return $this->method_id;
    }

    /**
     * @param int $method_id
     */
    public function SetMethodId($method_id)
    {
        $this->method_id = $method_id;
    }

    /**
     * @return array
     */
    public function getMetaData()
    {
        return $this->meta_data;
    }

    /**
     * @param array $meta_data
     */
    public function setMetaData(array $meta_data)
    {
        $this->meta_data = $meta_data;
    }
}