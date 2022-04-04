<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Postcode\BaseAdapter;
use App\Http\Controllers\Postcode\KpnAdapter;
use App\Http\Controllers\Postcode\OnlineAdapter;
use App\Http\Controllers\Postcode\SolconAdapter;
use App\Http\Controllers\Postcode\YoufoneAdapter;
use App\Http\Controllers\Postcode\ZiggoAdapter;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PostcodeCheck
{
    /**
     * @var BaseAdapter[]
     */
    private array $adapters;

    public function __construct(Client $client)
    {
        $this->adapters = [
            // new BudgetAdapter($client),
            // new EdpNetAdapter($client),
            // new FiberAdapter($client),
            new KpnAdapter($client),
            new OnlineAdapter($client),
            new SolconAdapter($client),
            // new StipteAdapter($client),
            new YoufoneAdapter($client),
            new ZiggoAdapter($client),
        ];
    }

    public function show(Request $request)
    {
        if ('submit' === $request->get('submit')) {
            $postcode = $request->get('postcode');
            $huisnr = $request->get('huisnr');
            // $ext = $request->get('ext');

            $url = implode('/', [
                'postcode',
                $postcode,
                $huisnr,
            ]);

            return redirect('/'.$url);
        }

        return view('postcode');
    }

    public function check($postcode, $houseNumber)
    {
        $result = [];

        foreach ($this->adapters as $adapter) {
            $result[$adapter->getName()] = $adapter->check($postcode, $houseNumber);
        }

        return $result;
    }
}
