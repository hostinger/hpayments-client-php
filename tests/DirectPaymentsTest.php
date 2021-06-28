<?php

namespace HPayments\Tests;

use GuzzleHttp\Exception\GuzzleException;
use Hpayments\APIContext;
use Hpayments\Tests\Traits\CreatePaymentTrait;
use PHPUnit\Framework\TestCase;

class DirectPaymentsTest extends TestCase
{
    use CreatePaymentTrait;

    /**
     * @var APIContext $client
     */
    private $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new APIContext('be75Nj5Xll6i0deks8h3', 'http://hpayments.hostinger.local');
    }

    /**
     * @return array
     */
    public function directPaymentFormProvider()
    {
        return [
            [
                'processout', 'processout_token'
            ],
            [
                'braintree_paypal', 'paypal-button'
            ]
        ];
    }

    /**
     * @dataProvider directPaymentFormProvider
     *
     * @param $merchantAccount
     * @param $formValidationKeyword
     * @throws GuzzleException
     */
    public function testShowsDirectPaymentForm($merchantAccount, $formValidationKeyword)
    {
        $result = $this->client->getDirectPaymentForm($merchantAccount);

        $generatedForm = $result['data']['form'];
        $this->assertTrue(strpos($generatedForm, $formValidationKeyword) !== false);
    }

    /**
     * @return array
     */
    public function directPaymentMethodFormProvider()
    {
        return [
            [
                'processout_apm', 'sandbox',
            ],
            [
                'processout_apm', 'coinpayments',
            ]
        ];
    }

    /**
     * @dataProvider directPaymentMethodFormProvider
     *
     * @param $merchantAccount
     * @param $paymentMethod
     * @throws GuzzleException
     */
    public function testShowsDirectPaymentMethodForm($merchantAccount, $paymentMethod)
    {
        $result = $this->client->getDirectPaymentMethodForm(
            $merchantAccount,
            $paymentMethod
        );
        $generatedForm = $result['data']['form'];
        $paymentMethodInResult = $this->getStringBetween(
            $generatedForm,
            'config.gateway.name === "', '"'
        );
        $this->assertEquals($paymentMethod, $paymentMethodInResult);
    }
}
