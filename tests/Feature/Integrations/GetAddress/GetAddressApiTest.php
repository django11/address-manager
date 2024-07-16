<?php

declare(strict_types=1);

namespace Tests\Feature\Integrations\GetAddress;

use App\Integrations\GetAddress\Dtos\AddressCollectionDto;
use App\Integrations\GetAddress\GetAddressApi;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class GetAddressApiTest extends TestCase
{
    /**
     * @throws \JsonException
     */
    public function test_gets_addresses_by_post_code(): void
    {
        $result = $this->makeGetAddressApi([
            'suggestions' => [
                [
                    'address' => 'Westminster Abbey, 20 Deans Yard, London, SW1P 3PA',
                    'url' => '/get/ZTA0MTc5YzQyNTAyYWMzIDE1MTAzMzA5MjcgYzY4NzczMzBkMTIxYjcx',
                    'id' => 'ZTA0MTc5YzQyNTAyYWMzIDE1MTAzMzA5MjcgYzY4NzczMzBkMTIxYjcx',
                ],
                [
                    'address' => 'King\'s House, Westminster, London, SW1P 3PA',
                    'url' => '/get/kings-house-11',
                    'id' => 'kings-house-22',
                ],
                [
                    'address' => 'William\'s House, Westminster, London, SW1P 3PA',
                    'url' => '/get/williams-house-11',
                    'id' => 'williams-house-11',
                ],
            ]
        ])->getAddressesByPostCode('SW1P 3PA');

        $this->assertInstanceOf(AddressCollectionDto::class, $result);
        $this->assertCount(3, $result);

        $this->assertEquals('Westminster Abbey, 20 Deans Yard, London, SW1P 3PA', $result->first()->address);
        $this->assertEquals('/get/ZTA0MTc5YzQyNTAyYWMzIDE1MTAzMzA5MjcgYzY4NzczMzBkMTIxYjcx', $result->first()->url);
        $this->assertEquals('ZTA0MTc5YzQyNTAyYWMzIDE1MTAzMzA5MjcgYzY4NzczMzBkMTIxYjcx', $result->first()->id);
    }

    /**
     * @throws \JsonException
     */
    private function makeGetAddressApi(array $responseMock): GetAddressApi
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['X-Foo' => 'Bar'],
                json_encode($responseMock, JSON_THROW_ON_ERROR)
            ),
        ]);

        $handlerStack = HandlerStack::create($mock);

        return new GetAddressApi(
            new Client(['handler' => $handlerStack])
        );
    }
}
