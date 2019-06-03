<?php

namespace Hpayments;

use Exception;

/**
 * Class Gateways
 * @package Hpayments
 */
class MerchantAccounts extends PaymentModel
{
    protected $merchant_accounts;

    /**
     * MerchantAccounts constructor.
     * @param array $merchantAccounts
     * @throws Exception
     */
    public function __construct(array $merchantAccounts)
    {
        $this->merchant_accounts = $merchantAccounts;
    }

    /**
     * @return array|mixed|object
     */
    public function jsonSerialize()
    {
        return (array) get_object_vars($this)['merchant_accounts'];
    }
}