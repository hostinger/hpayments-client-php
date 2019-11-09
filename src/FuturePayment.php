<?php

namespace Hpayments;

use JsonSerializable;

/**
 * Class Payment
 * @package Hpayments
 */
class FuturePayment implements JsonSerializable
{
    private $payer_details;
    private $redirect_urls;
    private $merchant_account;

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getRedirectUrls()
    {
        return $this->redirect_urls;
    }

    /**
     * @param RedirectUrls $redirect_urls
     */
    public function setRedirectUrls(RedirectUrls $redirect_urls)
    {
        $this->redirect_urls = $redirect_urls;
    }

    /**
     * @return string
     */
    public function getMerchantAccount()
    {
        return $this->redirect_urls;
    }

    /**
     * @param string $merchantAccount
     */
    public function setMerchantAccount($merchantAccount)
    {
        $this->merchant_account = $merchantAccount;
    }

    /**
     * @return object
     */
    public function jsonSerialize()
    {
        return (object)get_object_vars($this);
    }
}