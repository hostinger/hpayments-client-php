<?php

namespace Hpayments;

use JsonSerializable;

/**
 * Class Payment
 * @package Hpayments
 */
class Payment implements JsonSerializable
{
    private $payer_details;
    private $transaction_details;
    private $items;
    private $redirect_urls;
    private $merchant_accounts;

    /**
     * @return mixed
     */
    public function getPayerDetails()
    {
        return $this->payer_details;
    }

    /**
     * @param mixed $payerDetails
     */
    public function setPayerDetails(Payer $payer_details)
    {
        $this->payer_details = $payer_details;
    }

    /**
     * @return mixed
     */
    public function getTransactionDetails()
    {
        return $this->transaction_details;
    }

    /**
     * @param mixed $transactionDetails
     */
    public function setTransactionDetails(Transaction $transaction_details)
    {
        $this->transaction_details = $transaction_details;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems(Items $items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrls()
    {
        return $this->redirect_urls;
    }

    /**
     * @param mixed $redirect_urls
     */
    public function setRedirectUrls(RedirectUrls $redirect_urls)
    {
        $this->redirect_urls = $redirect_urls;
    }

    /**
     * @return mixed
     */
    public function getMerchantAccounts()
    {
        return $this->merchant_accounts;
    }

    /**
     * @param mixed $gateways
     */
    public function setMerchantAccounts(MerchantAccounts $merchantAccounts)
    {
        $this->merchant_accounts = $merchantAccounts;
    }

    /**
     * @return mixed|object
     */
    public function jsonSerialize()
    {
        return (object)get_object_vars($this);
    }
}