<?php

namespace App\Integrations\GetAddress;

use App\Integrations\GetAddress\Dtos\AddressCollectionDto;

interface GetAddress
{
    public function getAddressesByPostCode(string $postCode): AddressCollectionDto;
}
