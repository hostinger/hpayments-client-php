<?php

namespace Hpayments;

use Exception;

/**
 * Class Gateways
 * @package Hpayments
 */
class Gateways extends PaymentModel
{
    const PROCESSOUT       = 'processout';
    const BRAINTREE        = 'braintree';
    const BRAINTREE_PAYPAL = 'braintree_paypal';

    protected $gateways;

    /**
     * Gateways constructor.
     * @param array $gateways
     * @throws Exception
     */
    public function __construct(array $gateways)
    {
        foreach ($gateways as $gateway) {
            if (!in_array($gateway, array(self::BRAINTREE, self::PROCESSOUT, self::BRAINTREE_PAYPAL))) {
                throw new Exception('Gateway does not exist.');
            }
        }

        $this->gateways = $gateways;
    }

    /**
     * @return array|mixed|object
     */
    public function jsonSerialize()
    {
        return (array) get_object_vars($this)['gateways'];
    }
}