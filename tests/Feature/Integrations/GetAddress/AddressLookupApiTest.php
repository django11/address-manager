<?php

declare(strict_types=1);

namespace Tests\Feature\Integrations\GetAddress;

use App\Integrations\GetAddress\Dtos\AddressCollectionDto;
use App\Integrations\GetAddress\AddressLookupApi;
use App\Integrations\GetAddress\Dtos\AddressDetailsDto;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use JsonException;
use Tests\TestCase;

class AddressLookupApiTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function test_gets_addresses_by_post_code(): void
    {
        $result = $this->makeAddressLookupApi([
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
     * @throws JsonException
     */
    public function test_gets_address_by_id(): void
    {
        $result = $this->makeAddressLookupApi([
            'postcode' => 'SW1P 3PA',
            'latitude' => 51.4985,
            'longitude' => -0.128555,
            'formatted_address' => [
                '2 The Cloisters',
                'Deans Yard',
                '',
                'London',
                ''
            ],
            'thoroughfare' => 'Deans Yard',
            'building_name' => 'The Cloisters',
            'sub_building_name' => '',
            'sub_building_number' => '',
            'building_number' => '2',
            'line_1' => '2 The Cloisters',
            'line_2' => 'Deans Yard',
            'line_3' => '',
            'line_4' => '',
            'locality' => '',
            'town_or_city' => 'London',
            'county' => '',
            'district' => 'Westminster',
            'country' => 'England',
            'residential' => true
       ])->getById('SW1P 3PA');

        $this->assertInstanceOf(AddressDetailsDto::class, $result);
        $this->assertEquals('London', $result->townOrCity);
        $this->assertEquals('SW1P 3PA', $result->postCode);
    }

    /**
     * @throws JsonException
     */
    private function makeAddressLookupApi(array $responseMock): AddressLookupApi
    {
        $mock = new MockHandler([
            new Response(
                200,
                ['X-Foo' => 'Bar'],
                json_encode($responseMock, JSON_THROW_ON_ERROR)
            ),
        ]);

        $handlerStack = HandlerStack::create($mock);

        return new AddressLookupApi(
            new Client(['handler' => $handlerStack])
        );
    }
}
