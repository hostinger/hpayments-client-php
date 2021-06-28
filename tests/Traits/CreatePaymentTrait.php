<?php

namespace Hpayments\Tests\Traits;

use Hpayments\APIContext;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\MerchantAccounts;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;

trait CreatePaymentTrait
{
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
            'invoice_number' => rand(100000, 999999),
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
    protected function getRandomWord(int $len = 10): string
    {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);

        return substr(implode($word), 0, $len);
    }

    /**
     * @return string
     */
    private function getRandomEmail(): string
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
    private function getStringBetween(string $haystack, string $opening, string $closing): string
    {
        $strPosOpening = strpos($haystack, $opening);
        $this->assertNotFalse($strPosOpening);
        $subString = substr($haystack, $strPosOpening + strlen($opening), strlen($haystack));
        $strPosClosing = strpos($subString, $closing);
        $this->assertNotFalse($strPosClosing);

        return substr($subString, 0, $strPosClosing);
    }
}
