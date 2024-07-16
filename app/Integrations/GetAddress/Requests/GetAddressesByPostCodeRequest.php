<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress\Requests;

use App\Integrations\GetAddress\GetAddressesRequest;

readonly class GetAddressesByPostCodeRequest implements GetAddressesRequest
{
    public function __construct(private string $postCode)
    {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function resolveEndpoint(): string
    {
        return "autocomplete/$this->postCode";
    }

    public function body(): array
    {
        return [];
    }
}
