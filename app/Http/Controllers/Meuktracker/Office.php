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

        $bit = 1;
        if (Request::exists('32')) {
            $bit = 0;
        }

        return view('meuktracker/office', ['items' => $items, 'bit' => $bit]);
    }

    public function getUrlOffice2016PU(string $overviewUrl)
    {
        $office2016listXpath = '//*[@id="main"]/table[1]/tbody/tr/td[3]/a';
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
        $doc->loadHTML($html);

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

        $hrefs = [];
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
                'http://www.microsoft.com/download/details',
                'https://www.microsoft.com/download/details',
            ];

            if (!Str::startsWith($href, $downloadUrls)) {
                continue;
            }

            $hrefs[] = $this->getItem($href, $name);
        }

        return $hrefs;
    }

    public function getItem(string $href, string $name)
    {
        $url = $this->detailsToFile($href);

        $filename = $this->meuktracker->getFileName($url);
        $headers = $this->meuktracker->cacheHeaders($url);

        return [
            'name' => $name,
            'url' => $url,
            'filename' => $filename,
            'date' => strtotime($headers['last-modified']),
            'size' => $this->meuktracker->formatBytes((int) $headers['content-length']),
        ];
    }

    public function detailsToFile(string $detailsUrl)
    {
        $headers = $this->meuktracker->cacheHeaders($detailsUrl);
        if (\is_array($headers['location'])) {
            $headers['location'] = last($headers['location']);
        }
        $baseUrl = (string) $headers['location'];
        $confirmUrl = str_replace('download/details.aspx', 'download/confirmation.aspx', $baseUrl);
        $confirmUrl = str_replace('http://', 'https://', $confirmUrl);

        $links = $this->getAllLinks($confirmUrl, '//download.microsoft.com/download/');

        return $links[0];
    }

    public function getAllLinks(string $url, string $contains = '')
    {
        $page = $this->meuktracker->cachePage($url);

        $doc = new DOMDocument();
        $doc->loadHTML($page);
        $return = [];
        $aHrefs = $doc->getElementsByTagName('a');
        foreach ($aHrefs as $a) {
            $href = trim($a->getAttribute('href'));
            if (!empty($contains)) {
                if (!str_contains($href, $contains)) { // skip non matches
                    continue;
                }
            }
            $return[] = $href;
        }

        return $return;
    }
}
