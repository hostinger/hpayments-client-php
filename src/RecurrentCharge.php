<?php

namespace Hpayments;

use Exception;

/**
 * Class Item
 * @package Hpayments
 */
class RecurrentCharge extends PaymentModel
{
    protected $customer_custom_id;
    protected $invoice_number;
    protected $currency;
    protected $method_id;
    protected $amount;

    /**
     * RecurrentCharge constructor.
     * @param $data
     * @throws Exception
     */
    public function __construct($data)
    {
        if (!isset($data['customer_custom_id']) && empty($data['customer_custom_id'])) {
            throw new Exception('Customer custom ID is not set.');
        }

        if (!isset($data['invoice_number']) && empty($data['invoice_number'])) {
            throw new Exception('Invoice number is not set.');
        }

        if (!isset($data['currency']) && empty($data['currency'])) {
            throw new Exception('Currency is not set.');
        }

        if (!isset($data['method_id']) && empty($data['method_id'])) {
            throw new Exception('Method ID is not set.');
        }

        if (!isset($data['amount']) && empty($data['amount'])) {
            throw new Exception('Amount is not set.');
        }

        $this->setDataFromArray($data);
    }

    /**
     * @return mixed
     */
    public function getCustomerCustomId()
    {
        return $this->customer_custom_id;
    }

    /**
     * @param mixed $customer_custom_id
     */
    public function setCustomerCustomId($customer_custom_id)
    {
        $this->customer_custom_id = $customer_custom_id;
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
    public function getMethodId()
    {
        return $this->method_id;
    }

    /**
     * @param mixed $method_id
     */
    public function setMethodId($method_id)
    {
        $this->method_id = $method_id;
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
}