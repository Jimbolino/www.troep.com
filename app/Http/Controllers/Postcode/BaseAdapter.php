<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Client;

abstract class BaseAdapter implements AdapterInterface
{
    protected Client $client;

    protected string $postcode;
    protected int $houseNumber;
    protected string $extension;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function setHouseNumber(int $houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function setExtension(string $extension)
    {
        $this->extension = $extension;

        return $this;
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

    public function formPost(string $url, array $data, array $extraOptions = []): array
    {
        $options = [
            'headers' => [
                'accept' => 'application/json, */*',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $data,
        ];

        $options = array_merge_recursive($options, $extraOptions);

        $response = $this->client->post($url, $options);

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    public function formPostHTML(string $url, array $data, array $extraOptions = []): string
    {
        $options = [
            'headers' => [
                'accept' => '*/*',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $data,
        ];

        $options = array_merge_recursive($options, $extraOptions);

        $response = $this->client->post($url, $options);

        return $response->getBody()->getContents();
    }
}
