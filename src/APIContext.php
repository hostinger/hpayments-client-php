<?php

namespace Hpayments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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
    public function __construct($apiToken, $baseUri)
    {
        $this->APIContext = $this->getClient($apiToken, $baseUri);
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
     * @throws GuzzleException
     */
    public function createPayment(Payment $payment)
    {
        $response = $this->getAPIContext()->request('POST', '/api/v1/payment', [
            'http_errors' => false,
            'body'        => json_encode($payment->jsonSerialize())
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function ping()
    {
        $response = $this->getAPIContext()->request('GET', '/api/ping', ['http_errors' => false]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function getPaymentInfo($token)
    {
        $response = $this->getAPIContext()->request('GET', '/api/v1/payment/' . $token, ['http_errors' => false]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function getMerchantAccounts()
    {
        $response = $this->getAPIContext()->request('GET', '/api/v1/gateway', ['http_errors' => false]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $customClientId
     * @return array
     * @throws GuzzleException
     */
    public function getClientPaymentMethods($customClientId)
    {
        $response = $this->getAPIContext()->request('GET', "/api/v1/valid-payment-method/{$customClientId}", ['http_errors' => false]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function chargeClient(RecurrentCharge $charge)
    {
        $response = $this->getAPIContext()->request('POST', '/api/v1/valid-payment-method', [
            'http_errors' => false,
            'body'        => json_encode($charge->jsonSerialize())
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}