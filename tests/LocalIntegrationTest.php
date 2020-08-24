<?php

namespace HPayments\Tests;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Hpayments\APIContext;
use Hpayments\FuturePayment;
use Hpayments\Payer;
use Hpayments\RedirectUrls;
use PHPUnit\Framework\TestCase;

/**
 * Class LocalIntegrationTest
 *
 * Tests against local hpayments environment.
 */
class LocalIntegrationTest extends TestCase
{
    const MERCHANT_PROCESSOUT = 'processout';
    const MERCHANT_BRAINTREE_PAYPAL    = 'braintree_paypal';
    /**
     * @var APIContext $client
     */
    private $client;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->client = new APIContext('be75Nj5Xll6i0deks8h3', 'http://localhost');
    }

    /**
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function testFuturePaymentCanBeCreated()
    {
        $futurePayment = new FuturePayment();

        $futurePayment->setPayerDetails(new Payer([
            'email'             => 'test@example.com',
            'custom_account_id' => 'h_123123',
            'document_required' => 1
        ]));

        $futurePayment->setRedirectUrls(new RedirectUrls([
            'return' => 'http://hostinger.com?status=1',
            'cancel' => 'http://hostinger.com?error=0'
        ]));

        $futurePayment->setMerchantAccounts([
            self::MERCHANT_PROCESSOUT,
            self::MERCHANT_BRAINTREE_PAYPAL,
        ]);

        return $this->client->createFuturePayment($futurePayment);
    }

    /**
     * @depends testFuturePaymentCanBeCreated
     * @param array $response
     * @return void
     */
    public function testFuturePaymentCreatedSuccessfully(array $response)
    {
        $this->assertResponseHasNoErrors($response);

        $this->assertEquals(200, $response['status']);
    }

    /**
     * @param array $response
     * @return void
     */
    private function assertResponseHasNoErrors(array $response)
    {
        if ($response['status'] === 422) {
            $this->assertEquals([], $response['error']['validation_messages']);
        }
    }
}
