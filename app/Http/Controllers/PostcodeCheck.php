<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Postcode\BaseAdapter;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\Utils;
use Illuminate\Http\Request;
use Throwable;

class PostcodeCheck
{
    /**
     * @var BaseAdapter[]
     */
    private array $adapters;

    public function __construct(Client $client)
    {
        $this->adapters = [
            new Postcode\BudgetAdapter($client),
            new Postcode\CheapConnectAdapter($client),
            new Postcode\DatawebAdapter($client),
            new Postcode\DeltaAdapter($client),
            new Postcode\FiberAdapter($client),
            new Postcode\FreedomAdapter($client),
            new Postcode\GlasnetAdapter($client),
            new Postcode\HeldenVanNuAdapter($client),
            new Postcode\JonazAdapter($client),
            new Postcode\KabelnoordAdapter($client),
            new Postcode\KabeltexAdapter($client),
            new Postcode\KliksafeAdapter($client),
            new Postcode\KpnAdapter($client),
            new Postcode\KpnZakelijkAdapter($client),
            new Postcode\MultifiberAdapter($client),
            new Postcode\NetrebelAdapter($client),
            new Postcode\OnlineAdapter($client),
            new Postcode\OnviAdapter($client),
            new Postcode\PlinqAdapter($client),
            new Postcode\RapidXSAdapter($client),
            new Postcode\SignetAdapter($client),
            new Postcode\SkpAdapter($client),
            new Postcode\SkvAdapter($client),
            new Postcode\SnlrAdapter($client),
            new Postcode\SolconAdapter($client),
            new Postcode\StarlinkAdapter($client),
            new Postcode\StipteAdapter($client),
            new Postcode\OdidoAdapter($client),
            new Postcode\TriNedAdapter($client),
            new Postcode\TweakAdapter($client),
            new Postcode\YoufoneAdapter($client),
            new Postcode\ZiggoAdapter($client),
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
        $promises = [];

        foreach ($this->adapters as $adapter) {
            $adapter->setPostcode($postcode);
            $adapter->setHouseNumber($houseNumber);
            $adapter->setExtension($extension);

            try {
                $promises[$adapter->getName()] = $adapter->checkAsync()->otherwise(static fn (Throwable $e) => ['error' => $e->getMessage()]);
            } catch (Throwable $e) {
                $promises[$adapter->getName()] = Create::promiseFor(['error' => $e->getMessage()]);
            }
        }

        return Utils::unwrap($promises);
    }
}
