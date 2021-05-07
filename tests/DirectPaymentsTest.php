<?php

namespace HPayments\Tests;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Hpayments\APIContext;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\MerchantAccounts;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;
use PHPUnit\Framework\TestCase;

class DirectPaymentsTest extends TestCase
{
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
     * @param $keyword
     * @throws GuzzleException
     */
    public function testShowsDirectPaymentForm($merchantAccount, $keyword)
    {
        $result = $this->client->getDirectPaymentForm($merchantAccount);
        $generatedForm = $result['data']['form'];
        $this->assertTrue(strpos($generatedForm, $keyword) !== false);
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

    /**
     * @param APIContext $paymentsApi
     * @return string
     * @throws Exception
     */
    protected function createPayment(APIContext $paymentsApi)
    {
        $payer = new Payer([
            'email'             => $this->getRandomEmail(),
            'custom_account_id' => 'h_' . rand(10000000, 99999999),
        ]);

        $somePrice = rand(1000, 9999);
        $transaction = new Transaction([
            'amount'         => $somePrice,
            'currency'       => 'USD',
            'description'    => 'Test payment for hosting.',
            'invoice_number' => rand(100000, 99999),
            'three_d_secure' => '1'
        ]);

        $item = new Item([
            'name'      => 'Test Hosting',
            'price_now' => $somePrice - 1,
        ]);

        $itemBag = new Items();
        $itemBag->addNewItem($item);

        $redirectUrls = new RedirectUrls(
            [
                'cancel' => 'https://www.hostinger.com/cancel',
                'return' => 'https://www.hostinger.com/success',
            ]
        );

        $response = $paymentsApi->getMerchantAccounts();

        $merchantAccounts = new MerchantAccounts($response['data']['merchant_account_ids']);

        $payment = new Payment();
        $payment->setPayerDetails($payer);
        $payment->setTransactionDetails($transaction);
        $payment->setItems($itemBag);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setMerchantAccounts($merchantAccounts);

        $response = $paymentsApi->createPayment($payment);

        $this->assertEquals(200, $response['status']);

        return $response['data']['token'];
    }

    /**
     * @param int $len
     * @return string
     */
    protected function getRandomWord($len = 10)
    {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);

        return substr(implode($word), 0, $len);
    }

    /**
     * @return string
     */
    private function getRandomEmail()
    {
        return $this->getRandomWord() . '@' . $this->getRandomWord() . '.com';
    }

    /**
     * @param string $haystack
     * @param string $opening
     * @param string $closing
     *
     * @return string
     */
    private function getStringBetween($haystack, $opening, $closing)
    {
        $strPosOpening = strpos($haystack, $opening);
        $this->assertNotFalse($strPosOpening);
        $subString = substr($haystack, $strPosOpening + strlen($opening), strlen($haystack));
        $strPosClosing = strpos($subString, $closing);
        $this->assertNotFalse($strPosClosing);

        return substr($subString, 0, $strPosClosing);
    }
}
