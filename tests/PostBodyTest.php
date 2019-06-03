<?php

namespace Hpayments\Tests;

use Hpayments\APIContext;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\MerchantAccounts;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;
use PHPUnit\Framework\TestCase;

class PostBodyTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testPayerEncode()
    {
        $payer = new Payer([
            'email'             => 'miranda@gmail.com',
            'custom_account_id' => '123',
            'first_name'        => 'miranda',
            'last_name'         => 'dobrin',
            'country_code'      => 'LT',
            'zip'               => '12345',
            'city'              => 'Vilnius',
            'address'           => 'Mokyklos g.18'
        ]);

        $objectToPost = json_encode($payer);
        $this->assertJson($objectToPost);

        return json_decode($objectToPost, true);
    }

    /**
     * @depends testPayerEncode
     */
    public function testPayerEncodedValues($data)
    {
        $this->assertNotEmpty($data['email']);
        $this->assertNotEmpty($data['custom_account_id']);
        $this->assertNotEmpty($data['first_name']);
        $this->assertNotEmpty($data['last_name']);
        $this->assertNotEmpty($data['country_code']);
        $this->assertNotEmpty($data['zip']);
        $this->assertNotEmpty($data['city']);
        $this->assertNotEmpty($data['address']);
    }

    /**
     * @throws \Exception
     */
    public function testTransactionEncode()
    {
        $transaction = new Transaction([
            'amount'         => '9999',
            'currency'       => 'EUR',
            'description'    => 'Payment for hosting.',
            'invoice_number' => '123',
            'three_d_secure' => '1',
            'legal_document' => '1231231230',
            'vat_percent'    => '15',
            'vat_amount'     => '1000',
            'meta_data'      => [
                'reseller_id'     => '5',
                'reseller_domain' => 'hostinger.com'
            ]
        ]);

        $objectToPost = json_encode($transaction);
        $this->assertJson($objectToPost);

        return json_decode($objectToPost, true);
    }

    /**
     * @depends testTransactionEncode
     */
    public function testTransactionEncodedValues($data)
    {
        $this->assertNotEmpty($data['amount']);
        $this->assertNotEmpty($data['currency']);
        $this->assertNotEmpty($data['description']);
        $this->assertNotEmpty($data['invoice_number']);
        $this->assertNotEmpty($data['three_d_secure']);
        $this->assertNotEmpty($data['legal_document']);
        $this->assertNotEmpty($data['vat_percent']);
        $this->assertNotEmpty($data['vat_amount']);
        $this->assertNotEmpty($data['meta_data']);
        $this->assertNotEmpty($data['meta_data']['reseller_id']);
        $this->assertNotEmpty($data['meta_data']['reseller_domain']);
    }

    /**
     * @throws \Exception
     */
    public function testItemsEncode()
    {
        $item = new Item([
            'name'         => 'Premium Hosting',
            'price_now'    => '1111',
            'price_before' => '2222',
            'period'       => 'Annually (Pay Every 12 Months)',
        ]);

        $item2 = new Item([
            'name'         => 'Premium Hosting',
            'price_now'    => '1111',
            'price_before' => '2222',
            'period'       => 'Annually (Pay Every 12 Months)',
        ]);

        $itemBag = new Items();
        $itemBag->addNewItem($item);
        $itemBag->addNewItem($item2);

        $objectToPost = json_encode($itemBag);
        $this->assertJson($objectToPost);

        return json_decode($objectToPost, true);
    }

    /**
     * @depends testItemsEncode
     */
    public function testItemsEncodedValues($data)
    {
        $this->assertNotEmpty($data[0]);
        $this->assertNotEmpty($data[0]['name']);
        $this->assertNotEmpty($data[0]['price_now']);
        $this->assertNotEmpty($data[0]['price_before']);
        $this->assertNotEmpty($data[0]['period']);

        $this->assertNotEmpty($data[1]);
        $this->assertNotEmpty($data[1]['name']);
        $this->assertNotEmpty($data[1]['price_now']);
        $this->assertNotEmpty($data[1]['price_before']);
        $this->assertNotEmpty($data[1]['period']);
    }

    /**
     * @throws \Exception
     */
    public function testRedirectUrlsEncode()
    {
        $redirect = new RedirectUrls(['cancel' => 'https://google.com', 'return' => 'https://hostinger.com']);

        $objectToPost = json_encode($redirect);
        $this->assertJson($objectToPost);

        return json_decode($objectToPost, true);
    }

    /**
     * @depends testRedirectUrlsEncode
     */
    public function testRedirectUrlsValues($data)
    {
        $this->assertNotEmpty($data['cancel']);
        $this->assertNotEmpty($data['return']);
    }

    /**
     * @throws \Exception
     */
    public function testGatewaysEncode()
    {
        $merchantAccounts = new MerchantAccounts(['braintree', 'braintree_paypal', 'processout']);

        $objectToPost = json_encode($merchantAccounts);
        $this->assertJson($objectToPost);

        return json_decode($objectToPost, true);
    }

    /**
     * @depends testGatewaysEncode
     */
    public function testMerchantAccountValues($data)
    {
        $this->assertNotEmpty($data[0]);
        $this->assertNotEmpty($data[1]);
        $this->assertNotEmpty($data[2]);
    }

    /**
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFullPayloadEncode()
    {
        $payer = new Payer([
            'email'             => 'rdereskevicius@gmail.com',
            'custom_account_id' => 'h_123',
            'first_name'        => 'Rytis',
            'last_name'         => 'Dereškevičius',
            'country_code'      => 'LT',
            'zip'               => '12345',
            'city'              => 'Vilnius',
            'address'           => 'Mokyklos g.18'
        ]);

        $transaction = new Transaction([
            'amount'         => '9999',
            'currency'       => 'EUR',
            'description'    => 'Payment for hosting.',
            'invoice_number' => '123',
            'three_d_secure' => '1',
            'legal_document' => '1231231230',
            'vat_percent'    => '15',
            'vat_amount'     => '1000',
            'meta_data'      => [
                'reseller_id'     => '5',
                'reseller_domain' => 'hostinger.com'
            ]
        ]);

        $item = new Item([
            'name'         => 'Premium Hosting',
            'price_now'    => '1111',
            'price_before' => '2222',
            'period'       => 'Annually (Pay Every 12 Months)',
        ]);

        $item2 = new Item([
            'name'         => 'Premium Hosting',
            'price_now'    => '1111',
            'price_before' => '2222',
            'period'       => 'Annually (Pay Every 12 Months)',
        ]);

        $itemBag = new Items();
        $itemBag->addNewItem($item);
        $itemBag->addNewItem($item2);

        $redirectUrls      = new RedirectUrls(['cancel' => 'https://google.com', 'return' => 'https://hostinger.com']);
        $merchantAccounts  = new MerchantAccounts(['processout', 'braintree', 'braintree_paypal']);

        $payment = new Payment();
        $payment->setPayerDetails($payer);
        $payment->setTransactionDetails($transaction);
        $payment->setItems($itemBag);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setMerchantAccounts($merchantAccounts);

        $objectToPost = json_encode($payment);
        $this->assertJson($objectToPost);

        return json_decode($objectToPost, true);
    }

    /**
     * @depends testFullPayloadEncode
     */
    public function testFullPayloadValues($data)
    {
        $this->assertNotEmpty($data['payer_details']['email']);
        $this->assertNotEmpty($data['payer_details']['custom_account_id']);
        $this->assertNotEmpty($data['payer_details']['first_name']);
        $this->assertNotEmpty($data['payer_details']['last_name']);
        $this->assertNotEmpty($data['payer_details']['country_code']);
        $this->assertNotEmpty($data['payer_details']['zip']);
        $this->assertNotEmpty($data['payer_details']['city']);
        $this->assertNotEmpty($data['payer_details']['address']);

        $this->assertNotEmpty($data['transaction_details']['amount']);
        $this->assertNotEmpty($data['transaction_details']['currency']);
        $this->assertNotEmpty($data['transaction_details']['description']);
        $this->assertNotEmpty($data['transaction_details']['invoice_number']);
        $this->assertNotEmpty($data['transaction_details']['three_d_secure']);
        $this->assertNotEmpty($data['transaction_details']['legal_document']);
        $this->assertNotEmpty($data['transaction_details']['vat_percent']);
        $this->assertNotEmpty($data['transaction_details']['vat_amount']);
        $this->assertNotEmpty($data['transaction_details']['meta_data']);
        $this->assertNotEmpty($data['transaction_details']['meta_data']['reseller_id']);
        $this->assertNotEmpty($data['transaction_details']['meta_data']['reseller_domain']);

        $this->assertNotEmpty($data['items'][0]);
        $this->assertNotEmpty($data['items'][0]['name']);
        $this->assertNotEmpty($data['items'][0]['price_now']);
        $this->assertNotEmpty($data['items'][0]['price_before']);
        $this->assertNotEmpty($data['items'][0]['period']);

        $this->assertNotEmpty($data['items'][1]);
        $this->assertNotEmpty($data['items'][1]['name']);
        $this->assertNotEmpty($data['items'][1]['price_now']);
        $this->assertNotEmpty($data['items'][1]['price_before']);
        $this->assertNotEmpty($data['items'][1]['period']);

        $this->assertNotEmpty($data['redirect_urls']['cancel']);
        $this->assertNotEmpty($data['redirect_urls']['return']);

        $this->assertNotEmpty($data['merchant_accounts'][0]);
        $this->assertNotEmpty($data['merchant_accounts'][1]);
        $this->assertNotEmpty($data['merchant_accounts'][2]);
    }
}