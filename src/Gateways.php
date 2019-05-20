<?php

namespace Hpayments;

use Exception;

class Gateways extends PaymentModel implements \JsonSerializable
{
    const PROCESSOUT       = 'processout';
    const BRAINTREE        = 'braintree';
    const BRAINTREE_PAYPAL = 'braintree_paypal';

    protected $gateways;

    public function __construct()
    {
        $this->gateways = array();
    }

    /**
     * @param array $gateways
     * @throws Exception
     */
    public function setGateways(array $gateways)
    {
        foreach ($gateways as $gateway) {
            if (!in_array($gateway, array(self::BRAINTREE, self::PROCESSOUT, self::BRAINTREE_PAYPAL))) {
                throw new Exception('Gateway does not exist.');
            }
        }

        $this->gateways = $gateways;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}