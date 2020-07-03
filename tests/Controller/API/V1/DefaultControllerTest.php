<?php

declare(strict_types=1);

namespace App\Tests\Controller\API\V1;

use App\Tests\WebTestCase;

final class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     * @param string $url
     * @test
     */
    public function ItCanSendResponseIfUrlExists(string $url): void
    {
        $client = clone self::$client;

        $client->request('GET', $url);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSame('Welcome to Symfony 5.1 API!', $response['data']['message']);
    }

    public function provideUrls(): array
    {
        return [
            ['/'],
            ['/api'],
            ['/api/v1'],
        ];
    }
}
