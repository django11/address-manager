<?php

declare(strict_types=1);

namespace Tests\Traits;

use App\Integrations\GetAddress\AddressLookup;
use App\Integrations\GetAddress\AddressLookupApiFake;

trait InteractsWithAddressLookupApi
{
    public function fakeAddressLookupApi(): AddressLookupApiFake
    {
        $addressLookupApiFake = new AddressLookupApiFake();
        $this->swap(AddressLookup::class, $addressLookupApiFake);

        return $addressLookupApiFake;
    }
}
