<?php

namespace HPayments\Tests;

use GuzzleHttp\Exception\GuzzleException;
use Hpayments\APIContext;
use Hpayments\Tests\Traits\CreatePaymentTrait;
use PHPUnit\Framework\TestCase;

class RenderInfoTest extends TestCase
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
     * @throws GuzzleException
     */
    public function testRendersInfo(): void
    {
        $merchantAccounts = $this->client->getMerchantAccounts();
        $merchantAccountsToIds = array_flip($merchantAccounts['data']['merchant_account_ids']);
        $this->assertTrue(isset($merchantAccountsToIds['midtrans']));
        $midtransId = $merchantAccountsToIds['midtrans'];

        $token = $this->createPayment($this->client);
        $response = $this->client->getAPIContext()->request('get', '/account/' . $midtransId . '/token/'
            . $token . '?pm=gopay');
        $pageViewResponse = $response->getBody()->getContents();
        $renderInfoResponse = $this->client->getRenderInfo($midtransId, $token, 'gopay');
        $qrCode = $this->getStringBetween($pageViewResponse, 'img id="qr-img" src="', '" alt="qr code');
        $this->assertEquals($qrCode, $renderInfoResponse['data']['info']['qrcode']);
    }
}
