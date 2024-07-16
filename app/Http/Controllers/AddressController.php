<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;

class AddressController extends Controller
{
    public function store(AddressStoreRequest $request): AddressResource
    {
        $address = Address::query()->create($request->validated());

        return AddressResource::make($address);
    }

    public function show(Address $address): AddressResource
    {
        return AddressResource::make($address);
    }
}
