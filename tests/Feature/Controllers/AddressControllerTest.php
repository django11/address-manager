<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Address;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    public function test_stores_address(): void
    {
        $this->postJson(route('addresses.store'), [
            'company_name' => 'King\'s Company',
            'address_1' => 'Westminster Abbey',
            'city' => 'London',
            'county' => '',
            'post_code' => 'SW1P 3PA',
            'country' => 'England',
            'longitude' => 51.4985,
            'latitude' => -0.128555,
        ])->assertCreated();
    }

    public function test_shows_validation_errors(): void
    {
        $this->postJson(route('addresses.store'), [
            'address_1' => 'Westminster Abbey',
            'city' => 'London',
            'county' => '',
            'post_code' => 'SW1P 3PA',
            'country' => 'England',
            'longitude' => 51.4985,
            'latitude' => -0.128555,
        ])->assertJsonValidationErrorFor('company_name');
    }

    public function test_shows_address(): void
    {
        /** @var Address $address */
        $address = Address::factory()->create(['company_name' => 'Princess Diana Business']);

        $response = $this->getJson(route('addresses.show', $address->id));

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'company_name' => $address->company_name,
                'post_code' => $address->post_code,
                'address_1' => $address->address_1,
                'address_2' => $address->address_2,
                'city' => $address->city,
                'county' => $address->county,
                'country' => $address->country,
                'longitude' => $address->longitude,
                'latitude' => $address->latitude,
            ]
        ]);

    }
}
