<?php

declare(strict_types=1);

namespace App\Http\Controllers\Meuktracker;

use App\Http\Controllers\Controller;
use DOMDocument;
use DOMElement;
use Illuminate\Cache\CacheManager;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Office extends Controller
{
    public const OVERVIEW_URL = 'https://docs.microsoft.com/en-us/officeupdates/office-updates-msi';

    private Meuktracker $meuktracker;

    public function __construct(CacheManager $cache, Factory $client)
    {
        $this->meuktracker = new Meuktracker($cache, $client);
    }

    public function show()
    {
        $url = $this->getUrlOffice2016PU(self::OVERVIEW_URL);
        $items = $this->extractKBlist($url);

        if (Request::exists('json')) {
            return $items;
        }

        $bit = 0;
        if (Request::exists('32')) {
            $bit = 1;
        }

        return view('meuktracker/office', ['items' => $items, 'bit' => $bit]);
    }

    public function getUrlOffice2016PU(string $overviewUrl)
    {
        $office2016listXpath = '/html/body/main/div[2]/div[1]/div[6]/table[1]/tbody/tr/td[3]/a';

        $elements = $this->meuktracker->cachePageXpath($overviewUrl, $office2016listXpath);

        $first = $elements->item(0);

        \assert($first instanceof DOMElement);

        return $first->getAttribute('href');
    }

    public function extractKBlist(string $url)
    {
        $baseUrl = Meuktracker::getBaseUrl($url);
        $html = $this->meuktracker->cachePage($url);

        $doc = new DOMDocument();
        $doc->loadHTML((string) $html);

        $return = [];

        $h3elements = $doc->getElementsByTagName('h3');
        $h3count = 0;

        foreach ($h3elements as $h3) {
            ++$h3count;
            $aHrefs = $h3->nextSibling->nextSibling->getElementsByTagName('a');
            $i = 0;
            $kbs = [];
            foreach ($aHrefs as $a) {
                $href = $baseUrl.$a->getAttribute('href');
                $name = trim($a->nodeValue);

                $kbs[] = [
                    'name' => $name,
                    'href' => $href,
                    'alt' => $i++ % 2 ? 'alt' : '',
                    'items' => $this->getDownloadURLs($href),
                ];
            }

            $return[] = [
                'name' => $h3->nodeValue,
                'kbs' => $kbs,
                'apiUrl' => $url,
            ];

            if (1 === $h3count) {
                break; // only show Office 2016 updates
            }
        }

        return $return;
    }

    public function getDownloadURLs(string $url)
    {
        $xpath = '//*[@id="supArticleContent"]/article';

        $section = $this->meuktracker->cachePageXpath($url, $xpath)->item(0);

        \assert($section instanceof DOMElement);

        $elements = $section->getElementsByTagName('a');

        $items = [];
        foreach ($elements as $element) {
            $name = $element->textContent;
            $href = $element->getAttribute('href');

            $skip = ['windows-update-faq', 'what-version-of-office',
                'how-to-obtain-microsoft-support', 'msrc.microsoft.com',
                'docs.microsoft.com', 'support.office.com',
                'description-of-the-standard-terminology',
                'microsoft.com/security', 'www.catalog.update.microsoft.com',
            ];
            if (Str::contains($href, $skip)) {
                continue;
            }

            $downloadUrls = [
                'https://www.microsoft.com/en-us/download/details.aspx',
            ];

            if (!Str::startsWith($href, $downloadUrls)) {
                continue;
            }

            $items = $this->getItems($href, $name);
        }

        return $items;
    }

    public function getItems(string $href, string $name)
    {
        $urls = $this->detailsToFile($href);

        $items = [];
        foreach ($urls as $url) {
            $filename = $this->meuktracker->getFileName($url);
            $headers = $this->meuktracker->cacheHeaders($url);

            $items[] = [
                'name' => $name,
                'url' => $url,
                'filename' => $filename,
                'date' => strtotime((string) $headers['last-modified']),
                'size' => $this->meuktracker->formatBytes((int) $headers['content-length']),
            ];
        }

        return $items;
    }

    public function detailsToFile(string $detailsUrl)
    {
        $xpath = '/html/body/div[3]/div/div[2]/main/div/div[1]/div/div/script[1]';

        $section = $this->meuktracker->cachePageXpath($detailsUrl, $xpath);
        $script = $section->item(0)->nodeValue ?? '';

        $json = str_replace('window.__DLCDetails__=', '', $script);
        $data = json_decode($json, true);

        $return = [];
        foreach ($data['dlcDetailsView']['downloadFile'] ?? [] as $file) {
            $return[] = $file['url'];
        }

        return $return;
    }
}
