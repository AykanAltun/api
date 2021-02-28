<?php
declare(strict_types=1);

namespace App\Tests\Controller\v1;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseTest extends WebTestCase
{
    /**
     * @var string
     */
    private string $purchaseUrl = 'http://localhost/api/v1/purchase';
    /**
     * @var string
     */
    private string $registerUrl = 'http://localhost/api/v1/register';
    /**
     * @var string
     */
    private string $applicationUrl = 'http://localhost/api/v1/application';
    /**
     * @var KernelBrowser
     */
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }

    /**
     * @dataProvider \App\DataProvider\v1\PurchaseDataProvider::providePurchaseRequest
     * @param $purchaseRequest
     */
    #[NoReturn]
    public function testPurchaseSuccess($purchaseRequest)
    {
        $this->client->request(Request::METHOD_POST, $this->applicationUrl);
        $applicationContent = (array) json_decode($this->client->getResponse()->getContent());
        $purchaseRequest['register']['appId'] = $applicationContent['appId'];
        $this->client->request(
            Request::METHOD_POST,
            $this->registerUrl,
            [],
            [],
            [],
            json_encode($purchaseRequest['register'])
        );
        $registerContent = (array) json_decode($this->client->getResponse()->getContent());
        if (empty($registerContent['token'])) {
            $this->markTestSkipped('Token bulunmadığı için test atlanmıştır.');
        }
        $this->client->request(
            Request::METHOD_POST,
            $this->purchaseUrl,
            [],
            [],
            ['HTTP_X_SESSION_TOKEN' => 'Bearer '.$registerContent['token']],
            json_encode($purchaseRequest['purchase'])
        );
        $purchaseResponse = $this->client->getResponse();
        $content = json_decode($purchaseResponse->getContent(), true);
        $this->assertEquals(
            Response::HTTP_OK,
            $purchaseResponse->getStatusCode(),
            'Statü kodu 200 değildir.'
        );
        $this->assertArrayHasKey('id', $content, 'Response içerisinde id gelmedi.');
        $this->assertNotEmpty($content['id'], 'Id boş geldi.');
        $this->assertArrayHasKey('uid', $content, 'Response içerisinde uid gelmedi.');
        $this->assertNotEmpty($content['uid'], 'uid boş geldi.');
        $this->assertArrayHasKey('appId', $content, 'Response içerisinde appId gelmedi.');
        $this->assertNotEmpty($content['appId'], 'appId boş geldi.');
        $this->assertArrayHasKey('price', $content, 'Response içerisinde price gelmedi.');
        $this->assertNotEmpty($content['price'], 'price boş geldi.');
        $this->assertArrayHasKey('expiredDate', $content, 'Response içerisinde expiredDate gelmedi.');
        $this->assertNotEmpty($content['expiredDate'], 'expiredDate boş geldi.');
        $this->assertArrayHasKey('status', $content, 'Response içerisinde status gelmedi.');
        $this->assertArrayHasKey('createdDate', $content, 'Response içerisinde createdDate gelmedi.');
        $this->assertNotEmpty($content['createdDate'], 'createdDate boş geldi.');
    }
}
