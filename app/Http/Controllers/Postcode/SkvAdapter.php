<?php

declare(strict_types=1);

namespace App\Http\Controllers\Postcode;

class SkvAdapter extends BaseAdapter
{
    public const URL = 'https://www.skv.nl/pccheck/pcc.php';

    public function checkAsync(): \GuzzleHttp\Promise\PromiseInterface
    {
        $url = self::URL.'?'.$this->postcode;

        return $this->getAsync($url)->then(static fn (\Psr\Http\Message\ResponseInterface $response) => [
            'url' => $url,
            'html' => $response->getBody()->getContents(),
        ]);
    }

    public function getName(): string
    {
        return 'skv';
    }
}
