<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress\Requests;

use App\Integrations\GetAddress\GetAddressesRequest;

readonly class GetAddressByIdRequest implements GetAddressesRequest
{
    public function __construct(private string $id)
    {
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function resolveEndpoint(): string
    {
        return "get/$this->id";
    }

    public function body(): array
    {
        return [];
    }
}
