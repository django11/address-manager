<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\AddressDetailsLookupResource;
use App\Http\Resources\AddressLookupResource;
use App\Integrations\GetAddress\AddressLookup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AddressLookupController extends Controller
{
    public function __construct(private readonly AddressLookup $addressLookupApi)
    {
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $addressLookups = $this->addressLookupApi->getAddressesByPostCode($request->get('post_code'));

        return AddressLookupResource::collection($addressLookups);
    }

    public function getById(string $id): AddressDetailsLookupResource
    {
        $addressDetailsLookup = $this->addressLookupApi->getById($id);

        return AddressDetailsLookupResource::make($addressDetailsLookup);
    }
}
