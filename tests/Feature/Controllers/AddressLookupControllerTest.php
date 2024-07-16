<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Tests\Traits\InteractsWithAddressLookupApi;

class AddressLookupControllerTest extends TestCase
{
    use InteractsWithAddressLookupApi;

    public function test_search_address(): void
    {
        $this->fakeAddressLookupApi();

        $response = $this->getJson(route('address-lookup.search', ['post_code' => 'fake-post-code']));

        $response->assertOk();
    }

    public function test_gets_by_id(): void
    {
        $this->fakeAddressLookupApi();

        $response = $this->getJson(route('address-lookup.get-by-id', 'fake-id'));

        $response->assertOk();
    }
}
