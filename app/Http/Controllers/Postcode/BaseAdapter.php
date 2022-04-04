<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Client;

abstract class BaseAdapter implements AdapterInterface
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function jsonPost(string $url, array $data, array $extraOptions = []): array
    {
        $options = [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
            'json' => $data,
        ];

        $options = array_merge_recursive($options, $extraOptions);

        $response = $this->client->post($url, $options);

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function formPost(string $url, array $data): array
    {
        $options = [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $data,
        ];

        $response = $this->client->post($url, $options);

        return (array) json_decode($response->getBody()->getContents(), true);
    }
}
