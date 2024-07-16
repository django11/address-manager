<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress\Dtos;

class AddressDto
{
    public function __construct(
        public string $id,
        public string $address,
        public string $url,
    ) {
    }

    public static function fromResponse(array $response): AddressDto
    {
        return new AddressDto(
            id: $response['id'],
            address: $response['address'],
            url: $response['url'],
        );
    }
}
