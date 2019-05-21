<?php

namespace Hpayments;

use GuzzleHttp\Client;

/**
 * Class APIContext
 * @package Hpayments
 */
class APIContext
{
    protected $APIContext;

    /**
     * APIContext constructor.
     * @param $apiToken
     */
    public function __construct($apiToken)
    {
        $this->APIContext = $this->getClient($apiToken);
    }

    /**
     * @return Client
     */
    private function getClient($apiToken, $baseUri)
    {
        return new Client([
            'base_uri' => $baseUri,
            'timeOut'  => 10,
            'headers'  => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $apiToken
            ]
        ]);
    }

    /**
     * @return Client
     */
    public function getAPIContext()
    {
        return $this->APIContext;
    }

    /**
     * Creates a payment.
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createPayment(Payment $payment)
    {
        $response = $this->getAPIContext()->request('POST', '/api/v1/payment', [
            'http_errors' => false,
            'body'        => json_encode($payment->jsonSerialize())
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}