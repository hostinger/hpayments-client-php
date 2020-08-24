<?php

namespace Hpayments;

use JsonSerializable;

/**
 * Class Payment
 * @package Hpayments
 */
class FuturePayment implements JsonSerializable
{
    /**
     * @var Payer $payer_details
     */
    private $payer_details;

    /**
     * @var RedirectUrls $redirect_urls
     */
    private $redirect_urls;

    /**
     * @var array $merchant_accounts
     */
    private $merchant_accounts;

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
     * @param array $merchantAccounts
     */
    public function setMerchantAccounts(array $merchantAccounts) {
        $this->merchant_accounts = $merchantAccounts;
    }

    /**
     * @return array
     */
    public function getMerchantAccounts() {
        return $this->merchant_accounts;
    }

    /**
     * @return object
     */
    public function jsonSerialize()
    {
        return (object)get_object_vars($this);
    }
}
