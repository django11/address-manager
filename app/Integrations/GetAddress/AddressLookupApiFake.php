<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress;

use App\Http\Resources\AddressDetailsLookupResource;
use App\Integrations\GetAddress\Dtos\AddressCollectionDto;
use App\Integrations\GetAddress\Dtos\AddressDetailsDto;
use App\Integrations\GetAddress\Dtos\AddressDto;

class AddressLookupApiFake implements AddressLookup
{
    public function getAddressesByPostCode(string $postCode): AddressCollectionDto
    {
        $mockedApiResponse = json_decode(
            <<<EOD
                {
                    "suggestions": [
                        {
                            "address": "2 The Cloisters, Deans Yard, London, SW1P 3PA",
                            "url": "/get/ZTU2MTU2YjdhNjE0MWMxIDEzNTYyNzc3IDg0YTllNGVhZmYwNDZhZA==",
                            "id": "ZTU2MTU2YjdhNjE0MWMxIDEzNTYyNzc3IDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "16 Deans Yard, London, SW1P 3PA",
                            "url": "/get/NzA3NmU5MGM0NjE4NjFiIDEzNTYyNzc4IDg0YTllNGVhZmYwNDZhZA==",
                            "id": "NzA3NmU5MGM0NjE4NjFiIDEzNTYyNzc4IDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "19a Deans Yard, London, SW1P 3PA",
                            "url": "/get/N2U5MjQzOTBmNzI1ZjgxIDEzNTYyNzc0IDg0YTllNGVhZmYwNDZhZA==",
                            "id": "N2U5MjQzOTBmNzI1ZjgxIDEzNTYyNzc0IDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "20 Deans Yard, London, SW1P 3PA",
                            "url": "/get/YTUwMTBkNmFmMTE0ZjU3IDI5MjA2OTcxNzYgODRhOWU0ZWFmZjA0NmFk",
                            "id": "YTUwMTBkNmFmMTE0ZjU3IDI5MjA2OTcxNzYgODRhOWU0ZWFmZjA0NmFk"
                        },
                        {
                            "address": "21 Deans Yard, London, SW1P 3PA",
                            "url": "/get/MTRkMDM0YWQ1MDhjN2U5IDEzNTYyNzgxIDg0YTllNGVhZmYwNDZhZA==",
                            "id": "MTRkMDM0YWQ1MDhjN2U5IDEzNTYyNzgxIDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "The Chapter House, Deans Yard, London, SW1P 3PA",
                            "url": "/get/NWI4NGUzMGYxOThiOTU0IDEzNTYyNzc2IDg0YTllNGVhZmYwNDZhZA==",
                            "id": "NWI4NGUzMGYxOThiOTU0IDEzNTYyNzc2IDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "The Chapter Office, 20 Deans Yard, London, SW1P 3PA",
                            "url": "/get/MWIwODk0YmMyNzE4MWY3IDEzNTYyNzc5IDg0YTllNGVhZmYwNDZhZA==",
                            "id": "MWIwODk0YmMyNzE4MWY3IDEzNTYyNzc5IDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "Westminster Abbey Bookshop, 20 Deans Yard, London, SW1P 3PA",
                            "url": "/get/ZDgxY2IwZGI4YzYxY2U5IDEzNTYyNzgwIDg0YTllNGVhZmYwNDZhZA==",
                            "id": "ZDgxY2IwZGI4YzYxY2U5IDEzNTYyNzgwIDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "Westminster Abbey Enterprises Ltd, The Chapter Office, 20 Deans Yard, London, SW1P 3PA",
                            "url": "/get/MTA1NjVhMDIzMGIyZDA0IDIzNDA5NDQ5NDUgODRhOWU0ZWFmZjA0NmFk",
                            "id": "MTA1NjVhMDIzMGIyZDA0IDIzNDA5NDQ5NDUgODRhOWU0ZWFmZjA0NmFk"
                        },
                        {
                            "address": "Westminster Abbey Library, Deans Yard, London, SW1P 3PA",
                            "url": "/get/NTI2OTFjNzM3MzM5YjJiIDEzNTYyNzc1IDg0YTllNGVhZmYwNDZhZA==",
                            "id": "NTI2OTFjNzM3MzM5YjJiIDEzNTYyNzc1IDg0YTllNGVhZmYwNDZhZA=="
                        },
                        {
                            "address": "Westminster Abbey, 20 Deans Yard, London, SW1P 3PA",
                            "url": "/get/ZTA0MTc5YzQyNTAyYWMzIDE1MTAzMzA5MjcgODRhOWU0ZWFmZjA0NmFk",
                            "id": "ZTA0MTc5YzQyNTAyYWMzIDE1MTAzMzA5MjcgODRhOWU0ZWFmZjA0NmFk"
                        },
                        {
                            "address": "Westminster School, Dean's Yard, London, SW1P 3PA",
                            "url": "/get/NTdiMzQzNDQ3ZmRkMjdlIDIzNDMxNzA1NzAgODRhOWU0ZWFmZjA0NmFk",
                            "id": "NTdiMzQzNDQ3ZmRkMjdlIDIzNDMxNzA1NzAgODRhOWU0ZWFmZjA0NmFk"
                        }
                    ]
                }
            EOD, true, 512, JSON_THROW_ON_ERROR
        );

        return (new AddressCollectionDto())->push(
            ...array_map(fn($address) => AddressDto::fromResponse($address), $mockedApiResponse['suggestions'])
        );
    }

    public function getById(string $id): AddressDetailsDto
    {
        $mockedApiResponse = json_decode(
            <<<EOD
                {
                    "postcode": "SW1P 3PA",
                    "latitude": 51.4985,
                    "longitude": -0.128555,
                    "formatted_address": [
                        "2 The Cloisters",
                        "Deans Yard",
                        "",
                        "London",
                        ""
                    ],
                    "thoroughfare": "Deans Yard",
                    "building_name": "The Cloisters",
                    "sub_building_name": "",
                    "sub_building_number": "",
                    "building_number": "2",
                    "line_1": "2 The Cloisters",
                    "line_2": "Deans Yard",
                    "line_3": "",
                    "line_4": "",
                    "locality": "",
                    "town_or_city": "London",
                    "county": "",
                    "district": "Westminster",
                    "country": "England",
                    "residential": true
                }
            EOD, true, 512, JSON_THROW_ON_ERROR
        );

        return AddressDetailsDto::fromResponse($mockedApiResponse);
    }
}
