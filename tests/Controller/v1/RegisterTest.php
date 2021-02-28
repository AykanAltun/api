<?php
declare(strict_types=1);

namespace App\Tests\Controller\v1;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterTest extends WebTestCase
{
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
     * @dataProvider \App\DataProvider\v1\RegisterDataProvider::provideRegisterRequest
     * @param $registerRequest
     */
    #[NoReturn]
    public function testRegisterSuccess($registerRequest)
    {
        $this->client->request(Request::METHOD_POST, $this->applicationUrl);
        $applicationContent = (array) json_decode($this->client->getResponse()->getContent());
        $registerRequest['appId'] = $applicationContent['appId'];
        $this->client->request(Request::METHOD_POST, $this->registerUrl, [], [], [], json_encode($registerRequest));
        $response = $this->client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode(), 'Statü kodu 200 değildir.');
        $this->assertArrayHasKey(
            'token',
            json_decode($response->getContent(), true),
            'Response içerisinde token gelmedi.'
        );
        $this->assertNotEmpty(
            json_decode($response->getContent(), true)['token'],
            'Token boş geldi.'
        );
    }
}
