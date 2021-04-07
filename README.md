# HPayments PHP Client ![Generic badge](https://img.shields.io/badge/v-1.2.2-<COLOR>.svg) [![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)

This client is used to create payments for hPayments SaaS system.

---

# Table of content

- [Client Description](#hpayments-php-client)
- [Installation](#installation)
- [How To](#how-to)
    - [Minimal Details Usage](#minimal-details-usage)
    - [Full Details Usage](#full-details-usage)
    - [Run PHPUnit Tests](#run-phpunit-tests)
- [License](#license)

---

# Installation

```bash
composer require hostinger/hpayments-client-php
```

---

# How To
# Minimal Details Usage

```php
<?php

use Hpayments\APIContext;
use Hpayments\MerchantAccounts;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;

$payer = new Payer([
    'email'             => 'sales@hostinger.com',
    'custom_account_id' => 'h_123'
]);

$transaction = new Transaction([
    'amount'         => '9999',
    'currency'       => 'EUR',
    'description'    => 'Payment for hosting.',
    'invoice_number' => '123',
    'three_d_secure' => '1'
]);

$item = new Item([
    'name'         => 'Premium Hosting',
    'price_now'    => '1111',
]);

$itemBag = new Items();
$itemBag->addNewItem($item);

$redirectUrls = new RedirectUrls(['cancel' => 'https://www.hostinger.com/cancel', 'return' => 'https://www.hostinger.com/success']);

$paymentsApi = new APIContext('your_api_token', 'http://localhost');
$response    = $paymentsApi->getMerchantAccounts();

$merchantAccounts = new MerchantAccounts($response['data']['merchant_account_ids']);

$payment = new Payment();
$payment->setPayerDetails($payer);
$payment->setTransactionDetails($transaction);
$payment->setItems($itemBag);
$payment->setRedirectUrls($redirectUrls);
$payment->setMerchantAccounts($merchantAccounts);

$response = $paymentsApi->createPayment($payment);

if (!$response['success']){
    echo $response['error']['message'];
} else {
    echo $response['data']['redirect_link'];
}
```

---

# Full Details Usage
```php
<?php

use Hpayments\APIContext;
use Hpayments\MerchantAccounts;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;

$payer = new Payer([
    'email'             => 'sales@hostinger.com',
    'custom_account_id' => 'h_123',
    'first_name'        => 'John',
    'last_name'         => 'Doe',
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

$redirectUrls = new RedirectUrls(['cancel' => 'https://www.hostinger.com/cancel', 'return' => 'https://www.hostinger.com/success']);

$paymentsApi = new APIContext('your_api_token', 'http://localhost');
$response    = $paymentsApi->getMerchantAccounts();

$merchantAccounts = new MerchantAccounts($response['data']['merchant_account_ids']);

$payment = new Payment();
$payment->setPayerDetails($payer);
$payment->setTransactionDetails($transaction);
$payment->setItems($itemBag);
$payment->setRedirectUrls($redirectUrls);
$payment->setMerchantAccounts($merchantAccounts);

$response = $paymentsApi->createPayment($payment);

if (!$response['success']){
    echo $response['error']['message'];
} else {
    echo $response['data']['redirect_link'];
}
```

# Future payment usage
```php
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
            'processout',
            'braintree_paypal',
        ]);

        return $this->client->createFuturePayment($futurePayment);
```

# Direct payments usage

For direct payments usage, read DirectPayments.md which is located in docs/DirectPayments in this repository.

- You can find all available REST endpoints in `APIContext.php` file

---

# Run PHPUnit Tests

1. `composer install --dev` to install 5.7 PHPUnit.
2. run `./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/PostBodyTest.php`
3. if you have local hPayments environment you can also run integration tests  
`./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/LocalIntegrationTest.php`
---

# License
[![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)
