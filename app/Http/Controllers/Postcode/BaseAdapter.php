<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

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

    public function check(): array
    {
        return $this->checkAsync()->wait();
    }

    public function checkAsync(): PromiseInterface
    {
        return \GuzzleHttp\Promise\Create::promiseFor($this->check());
    }

    public function getAsync(string $url, array $options = []): PromiseInterface
    {
        return $this->client->getAsync($url, $options);
    }

    public function getJsonAsync(string $url, array $options = []): PromiseInterface
    {
        return $this->getAsync($url, $options)->then(static fn (ResponseInterface $response) => (array) json_decode($response->getBody()->getContents(), true));
    }

    public function jsonPostAsync(string $url, array $data, array $extraOptions = []): PromiseInterface
    {
        $options = [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
            'json' => $data,
        ];

        $options = array_merge_recursive($options, $extraOptions);

        return $this->client->postAsync($url, $options)->then(static fn (ResponseInterface $response) => (array) json_decode($response->getBody()->getContents(), true));
    }

    public function formPostAsync(string $url, array $data, array $extraOptions = []): PromiseInterface
    {
        $options = [
            'headers' => [
                'accept' => 'application/json, */*',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $data,
        ];

        $options = array_merge_recursive($options, $extraOptions);

        return $this->client->postAsync($url, $options)->then(static fn (ResponseInterface $response) => (array) json_decode($response->getBody()->getContents(), true));
    }

    public function formPostHTMLAsync(string $url, array $data, array $extraOptions = []): PromiseInterface
    {
        $options = [
            'headers' => [
                'accept' => '*/*',
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $data,
        ];

        $options = array_merge_recursive($options, $extraOptions);

        return $this->client->postAsync($url, $options)->then(static fn (ResponseInterface $response) => $response->getBody()->getContents());
    }
}
