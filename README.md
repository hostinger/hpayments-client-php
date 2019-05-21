# HPayments PHP Client ![Generic badge](https://img.shields.io/badge/v-1.0.0-<COLOR>.svg) [![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)

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
In your composer.json add the repository:

1. Add these lines to your composer file:
```
"require": {
    "hostinger/hpayments-client-php": "dev-master"
}
...
"repositories": [
  {
    "type": "vcs",
    "url": "git@github.com:hostinger/hpayments-client-php.git"
  }
]

```
2. Hit `composer install` and `composer update`

---

# How To
# Minimal Details Usage

```php
<?php

use Hpayments\APIContext;
use Hpayments\Gateways;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;

require_once __DIR__ . '/../vendor/autoload.php';

$payer = new Payer([
    'email'             => 'rdereskevicius@gmail.com',
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

$redirectUrls = new RedirectUrls(['cancel' => 'https://google.com', 'return' => 'https://hostinger.com']);
$gateways     = new Gateways([Gateways::PROCESSOUT]);

$payment = new Payment();
$payment->setPayerDetails($payer);
$payment->setTransactionDetails($transaction);
$payment->setItems($itemBag);
$payment->setRedirectUrls($redirectUrls);
$payment->setGateways($gateways);

$paymentsApi = new APIContext('your_api_token', 'http://localhost');
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
use Hpayments\Gateways;
use Hpayments\Item;
use Hpayments\Items;
use Hpayments\Payer;
use Hpayments\Payment;
use Hpayments\RedirectUrls;
use Hpayments\Transaction;

require_once __DIR__ . '/../vendor/autoload.php';

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

$redirectUrls = new RedirectUrls(['cancel' => 'https://google.com', 'return' => 'https://hostinger.com']);
$gateways     = new Gateways([Gateways::BRAINTREE, Gateways::PROCESSOUT, Gateways::BRAINTREE_PAYPAL]);

$payment = new Payment();
$payment->setPayerDetails($payer);
$payment->setTransactionDetails($transaction);
$payment->setItems($itemBag);
$payment->setRedirectUrls($redirectUrls);
$payment->setGateways($gateways);

$paymentsApi = new APIContext('your_api_token', 'http://localhost');
$response = $paymentsApi->createPayment($payment);

if (!$response['success']){
    echo $response['error']['message'];
} else {
    echo $response['data']['redirect_link'];
}
```

---

# Run PHPUnit Tests

1. `composer install --dev` to install 5.7 PHPUnit.
2. `./vendor/bin/phpunit tests/` inside `vendor/hostinger/hpayments-client-php`

---

# License
[![MIT license](https://img.shields.io/badge/License-MIT-blue.svg)](https://lbesson.mit-license.org/)