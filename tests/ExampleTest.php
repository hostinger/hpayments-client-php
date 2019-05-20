<?php

namespace Hpayments\Tests;

use Hpayments\Gateways;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testExample()
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
        var_dump($payer);
    }

    /**
     * @throws \Exception
     */
    public function testAnotherExample()
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
        var_dump($transaction);
    }

    /**
     * @throws \Exception
     */
    public function testThirdExample()
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

        var_dump($itemBag);
    }

    /**
     * @throws \Exception
     */
    public function testFourthExample()
    {
        $redirect = new RedirectUrls(['cancel' => 'https://google.com', 'return' => 'https://hostinger.com']);
        var_dump($redirect);
    }

    /**
     * @throws \Exception
     */
    public function testFifthExample()
    {
        $gateways = new Gateways();
        $gateways->setGateways([Gateways::BRAINTREE, Gateways::PROCESSOUT, Gateways::BRAINTREE_PAYPAL]);
        var_dump($gateways);
    }

    /**
     * @throws \Exception
     */
    public function testSixthExample()
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

        $redirectUrls = new RedirectUrls(['cancel' => 'https://google.com', 'return' => 'https://hostinger.com']);

        $gateways = new Gateways();
        $gateways->setGateways([Gateways::BRAINTREE, Gateways::PROCESSOUT, Gateways::BRAINTREE_PAYPAL]);

        $payment = new Payment();
        $payment->setPayer($payer);
        $payment->setTransaction($transaction);
        $payment->setItems($itemBag);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setGateways($gateways);

        $data = $payment->toJson();
    }
}