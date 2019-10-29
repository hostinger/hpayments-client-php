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
     * @param $baseUri
     */
    public function __construct($apiToken, $baseUri)
    {
        $this->APIContext = $this->getClient($apiToken, $baseUri);
    }

    /**
     * @param $apiToken
     * @param $baseUri
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
     * @param Payment $payment
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
     * @return array
     * @throws GuzzleException
     */
    public function ping()
    {
        $response = $this->getAPIContext()->request('GET', '/api/ping', ['http_errors' => false]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $token
     * @return array
     * @throws GuzzleException
     */
    public function getPaymentInfo($token)
    {
        $response = $this->getAPIContext()->request('GET', '/api/v1/payment/' . $token, ['http_errors' => false]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return array
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
     * @param RecurrentCharge $charge
     * @return array
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

    /**
     * @param $customerCustomId
     * @param $methodId
     * @return array
     * @throws GuzzleException
     */
    public function setDefaultCard($customerCustomId, $methodId)
    {
        $response = $this->getAPIContext()->request('PATCH', '/api/v1/valid-payment-method', [
            'http_errors' => false,
            'body'        => json_encode(['customer_custom_id' => $customerCustomId, 'method_id' => $methodId])
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $customerCustomId
     * @param $methodId
     * @return mixed
     * @throws GuzzleException
     */
    public function deletePaymentMethod($customerCustomId, $methodId)
    {
        $response = $this->getAPIContext()->request('DELETE', '/api/v1/valid-payment-method', [
            'http_errors' => false,
            'body'        => json_encode(['customer_custom_id' => $customerCustomId, 'method_id' => $methodId])
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $expiresFrom
     * @param string $expiresTo
     * @param bool   $getOnlyDefault
     * @return array
     * @throws GuzzleException
     * @example $expiresTo '2019-10-31'
     * @example $expiresFrom '2019-10-01'
     */
    public function getExpiringCards($expiresFrom, $expiresTo, $getOnlyDefault = false)
    {
        $httpQuery = http_build_query([
            'expires_from' => $expiresFrom,
            'expires_to'   => $expiresTo,
            'is_default'   => $getOnlyDefault
        ]);

        $response = $this->getAPIContext()->request('GET', '/api/v1/cards/expiring?' . $httpQuery, [
            'http_errors' => false,
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}