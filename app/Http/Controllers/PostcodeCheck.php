<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Postcode\BaseAdapter;
use App\Http\Controllers\Postcode\KpnAdapter;
use App\Http\Controllers\Postcode\OnlineAdapter;
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
            // new \App\Http\Controllers\Postcode\BudgetAdapter($client),
            // new \App\Http\Controllers\Postcode\CaiwayAdapter($client),
            // new \App\Http\Controllers\Postcode\CheapConnectAdapter($client),
            // new \App\Http\Controllers\Postcode\DatawebAdapter($client),
            // new \App\Http\Controllers\Postcode\DeltaAdapter($client),
            // new \App\Http\Controllers\Postcode\EdpNetAdapter($client),
            // new \App\Http\Controllers\Postcode\FiberAdapter($client),
            // new \App\Http\Controllers\Postcode\FreedomAdapter($client),
            // new \App\Http\Controllers\Postcode\GlasnetAdapter($client),
            // new \App\Http\Controllers\Postcode\HeldenVanNuAdapter($client),
            // new \App\Http\Controllers\Postcode\JonazAdapter($client),
            // new \App\Http\Controllers\Postcode\KabelnoordAdapter($client),
            // new \App\Http\Controllers\Postcode\KabeltexAdapter($client),
            // new \App\Http\Controllers\Postcode\KliksafeAdapter($client),
            new KpnAdapter($client),
            // new \App\Http\Controllers\Postcode\KpnZakelijkAdapter($client),
            // new \App\Http\Controllers\Postcode\MultifiberAdapter($client),
            // new \App\Http\Controllers\Postcode\NetrebelAdapter($client),
            new OnlineAdapter($client),
            // new \App\Http\Controllers\Postcode\OnviAdapter($client),
            // new \App\Http\Controllers\Postcode\PlinqAdapter($client),
            // new \App\Http\Controllers\Postcode\RapidXSAdapter($client),
            // new \App\Http\Controllers\Postcode\SignetAdapter($client),
            // new \App\Http\Controllers\Postcode\SkpAdapter($client),
            // new \App\Http\Controllers\Postcode\SkvAdapter($client),
            // new \App\Http\Controllers\Postcode\SnlrAdapter($client),
            // new \App\Http\Controllers\Postcode\SolconAdapter($client),
            // new \App\Http\Controllers\Postcode\StarlinkAdapter($client),
            // new \App\Http\Controllers\Postcode\StipteAdapter($client),
            // new \App\Http\Controllers\Postcode\TMobileAdapter($client),
            // new \App\Http\Controllers\Postcode\TriNedAdapter($client),
            // new \App\Http\Controllers\Postcode\TweakAdapter($client),
            // new \App\Http\Controllers\Postcode\YoufoneAdapter($client),
            new ZiggoAdapter($client),
        ];
    }

    public function show(Request $request)
    {
        if ('submit' === $request->get('submit')) {
            $postcode = $request->get('postcode');
            $huisnr = $request->get('huisnr');
            $ext = $request->get('ext');

            $url = implode('/', [
                'postcode',
                $postcode,
                $huisnr,
                $ext,
            ]);

            return redirect('/'.$url);
        }

        return view('postcode');
    }

    public function check($postcode, int $houseNumber, $extension = '')
    {
        $result = [];

        foreach ($this->adapters as $adapter) {
            $adapter->setPostcode($postcode);
            $adapter->setHouseNumber($houseNumber);
            $adapter->setExtension($extension);
            $result[$adapter->getName()] = $adapter->check();
        }

        return $result;
    }
}
