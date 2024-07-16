<?php

namespace App\Integrations\GetAddress;

use App\Http\Resources\AddressDetailsLookupResource;
use App\Integrations\GetAddress\Dtos\AddressCollectionDto;
use App\Integrations\GetAddress\Dtos\AddressDetailsDto;

interface AddressLookup
{
    public function getAddressesByPostCode(string $postCode): AddressCollectionDto;

    public function getById(string $id): AddressDetailsDto;
}
