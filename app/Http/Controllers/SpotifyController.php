<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Meuktracker\Meuktracker;
use Illuminate\Cache\CacheManager;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Arr;

class SpotifyController extends Controller
{
    private Meuktracker $meuktracker;

    public function __construct(CacheManager $cache, Factory $client)
    {
        $this->meuktracker = new Meuktracker($cache, $client);
    }

    public function index()
    {
        $url = 'https://www.spotify.com/nl-en/select-your-country-region/';
        $res = $this->meuktracker->cachePage($url);
        $res = $this->getNextData($res);

        return Arr::get($res, 'props.pageProps.markets');
    }

    public function show($country = 'nl')
    {
        $url = 'https://www.spotify.com/'.$country.'/premium/';
        $res = $this->meuktracker->cachePage($url);
        $res = $this->getNextData($res);

        $general = [
            'isEmergingMarketAssignment' => Arr::get($res, 'props.pageProps.isEmergingMarketAssignment'),
            'language' => Arr::get($res, 'props.pageProps.isEmergingMarketAssignment.basePageProps.language'),
            'country' => Arr::get($res, 'props.pageProps.isEmergingMarketAssignment.basePageProps.country'),
            'market' => Arr::get($res, 'props.pageProps.isEmergingMarketAssignment.basePageProps.market'),
        ];

        $plans = Arr::get($res, 'props.pageProps.components.storefront.plans');

        $planFilter = [
            'header',
            'isRecurringProduct',
            'subheaderPrice',
            'subheaderDuration',
            'primaryPriceDescription',
            'secondaryPriceDescription',
            'offerTypeId',
            'shortPlanName',
        ];

        $filteredPlans = [];
        foreach ($plans as $plan) {
            $filteredPlans[] = Arr::only($plan, $planFilter);
        }

        $icons = Arr::get($res, 'props.pageProps.components.storefront.icons');

        return [
            'general' => $general,
            'plans' => $filteredPlans,
            'icons' => $icons,
        ];
    }

    private function getNextData(string $res): array
    {
        $res = last(explode('">', $res));
        $res = explode('</script></body></html>', $res)[0];

        return (array) json_decode($res, true);
    }
}
