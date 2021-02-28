<?php
declare(strict_types=1);

namespace App\Tests\Controller\v1;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionTest extends WebTestCase
{
    /**
     * @var string
     */
    private string $subscriptionUrl = 'http://localhost/api/v1/subscription';
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
     * @dataProvider \App\DataProvider\v1\SubscriptionDataProvider::provideSubscriptionRequest
     * @param $subscriptionRequest
     */
    #[NoReturn]
    public function testSubscriptionSuccess($subscriptionRequest)
    {
        $this->client->request(Request::METHOD_POST, $this->applicationUrl);
        $applicationContent = (array) json_decode($this->client->getResponse()->getContent());
        $subscriptionRequest['appId'] = $applicationContent['appId'];
        $this->client->request(
            Request::METHOD_POST,
            $this->registerUrl,
            [],
            [],
            [],
            json_encode($subscriptionRequest)
        );
        $registerContent = (array) json_decode($this->client->getResponse()->getContent());
        if (empty($registerContent['token'])) {
            $this->markTestSkipped('Token bulunmadığı için test atlanmıştır.');
        }
        $this->client->request(
            Request::METHOD_GET,
            $this->subscriptionUrl,
            [],
            [],
            ['HTTP_X_SESSION_TOKEN' => 'Bearer '.$registerContent['token']],
        );
        $response = $this->client->getResponse();
        $content = json_decode($response->getContent(), true);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode(), 'Statü kodu 200 değildir.');
        $this->assertArrayHasKey('status', $content, 'Response içerisinde status gelmedi.');
        $this->assertNotEmpty($content['status'], 'Status boş geldi.');
    }
}
