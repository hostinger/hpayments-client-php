<?php

namespace Hpayments;

use JsonSerializable;

/**
 * Class RecurrentPayment
 * @package Hpayments
 */
class RecurrentPayment implements JsonSerializable
{
    private $payer_details;
    private $transaction_details;

    /**
     * @return Payer
     */
    public function getPayerDetails()
    {
        return $this->payer_details;
    }

    /**
     * @param Payer $payer_details
     */
    public function setPayerDetails(Payer $payer_details)
    {
        $this->payer_details = $payer_details;
    }

    /**
     * @return RecurrentTransaction
     */
    public function getTransactionDetails()
    {
        return $this->transaction_details;
    }

    /**
     * @param RecurrentTransaction $transaction_details
     */
    public function setTransactionDetails(RecurrentTransaction $transaction_details)
    {
        $this->transaction_details = $transaction_details;
    }

    /**
     * @return mixed|object
     */
    public function jsonSerialize()
    {
        return (object)get_object_vars($this);
    }
}