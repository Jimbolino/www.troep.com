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
            'language' => Arr::get($res, 'props.pageProps.basePageProps.language'),
            'country' => Arr::get($res, 'props.pageProps.basePageProps.country'),
            'market' => Arr::get($res, 'props.pageProps.basePageProps.market'),
        ];

        $plans = $this->getPlans(Arr::get($res, 'props.pageProps.components', []));

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

        return [
            'general' => $general,
            'plans' => $filteredPlans,
        ];
    }

    /**
     * Spotify serves two layouts of the premium page: the old one has the plans in components.storefront,
     * the new one (premium.voyager) has a list of components with the plans in the SpotlightSection.
     */
    private function getPlans(array $components): array
    {
        if (isset($components['storefront'])) {
            return Arr::get($components, 'storefront.plans', []);
        }

        foreach ($components as $component) {
            if ('SpotlightSection' === Arr::get($component, 'name')) {
                return Arr::get($component, 'attributes.plans', []);
            }
        }

        return [];
    }

    private function getNextData(string $res): array
    {
        $res = last(explode('">', $res));
        $res = explode('</script></body></html>', $res)[0];

        return (array) json_decode($res, true);
    }
}
