<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress\Dtos;

class AddressDetailsDto
{
    public function __construct(
        public string $postCode,
        public float $latitude,
        public float $longitude,
        public string $line1,
        public ?string $line2,
        public string $townOrCity,
        public ?string $county,
        public string $district,
        public string $country,
        public bool $residential,
    ) {
    }

    public static function fromResponse(array $response): AddressDetailsDto
    {
        return new AddressDetailsDto(
            postCode: $response['postcode'],
            latitude: $response['latitude'],
            longitude: $response['longitude'],
            line1: $response['line_1'],
            line2: $response['line_2'],
            townOrCity: $response['town_or_city'],
            county: $response['county'],
            district: $response['district'],
            country: $response['country'],
            residential: $response['residential'],
        );
    }

    public function toArray(): array
    {
        return [
            'post_code' => $this->postCode,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'line_1' => $this->line1,
            'line_2' => $this->line2,
            'town_or_city' => $this->townOrCity,
            'county' => $this->county,
            'district' => $this->district,
            'country' => $this->country,
            'residential' => $this->residential,
        ];
    }
}
