<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress\Dtos;

use Illuminate\Contracts\Support\Arrayable;

class AddressDto implements Arrayable
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'url' => $this->url,
        ];
    }
}
