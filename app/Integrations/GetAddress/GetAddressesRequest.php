<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress;

interface GetAddressesRequest
{
    public function getMethod(): string;

    public function resolveEndpoint(): string;

    public function body(): array;
}
