<?php

declare(strict_types=1);

namespace App\Integrations\GetAddress;

use App\Http\Resources\AddressDetailsLookupResource;
use App\Integrations\GetAddress\Dtos\AddressCollectionDto;
use App\Integrations\GetAddress\Dtos\AddressDetailsDto;
use App\Integrations\GetAddress\Dtos\AddressDto;
use App\Integrations\GetAddress\Requests\GetAddressByIdRequest;
use App\Integrations\GetAddress\Requests\GetAddressesByPostCodeRequest;
use GuzzleHttp\ClientInterface;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

readonly class AddressLookupApi implements AddressLookup
{
    public function __construct(private ClientInterface $guzzleClient)
    {
    }

    /**
     * @throws JsonException
     */
    public function getAddressesByPostCode(string $postCode): AddressCollectionDto
    {
        $response = $this->formatResponse(
            $this->send(new GetAddressesByPostCodeRequest($postCode))
        );

        return (new AddressCollectionDto())->push(
            ...array_map(fn($address) => AddressDto::fromResponse($address), $response['suggestions'])
        );
    }

    /**
     * @throws JsonException
     */
    public function getById(string $id): AddressDetailsDto
    {
        $response = $this->formatResponse(
            $this->send(new GetAddressByIdRequest($id))
        );

        return AddressDetailsDto::fromResponse($response);
    }

    /**
     * @param  ResponseInterface  $response
     * @return array
     * @throws JsonException
     */
    private function formatResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    private function send(GetAddressesRequest $request): ResponseInterface
    {
        $options = match ($request->getMethod()) {
            'POST' => ['json' => $request->body()],
            'GET' => ['query' => $request->body()],
            default => [],
        };

        $options['query']['api-key'] = config('services.get-address.token');

        $response = $this->guzzleClient->request(
            method: $request->getMethod(),
            uri: sprintf('%s/%s', config('services.get-address.api_url'), $request->resolveEndpoint()),
            options: $options
        );

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return $response;
        }

        throw new RuntimeException('Failed making request');
    }
}
