<?php

declare(strict_types=1);

namespace App\Http\Controllers\Meuktracker;

use App\Http\Controllers\Controller;
use DOMDocument;
use DOMNodeList;
use DOMXpath;
use Exception;
use Illuminate\Cache\CacheManager;
use Illuminate\Http\Client\Factory;

class Meuktracker extends Controller
{
    private const CACHE_TTL = 24 * 60 * 60;
    public array $products = [
        'Google Chrome 32' => [
            'download' => 'https://www.google.com/chrome/',
            'file' => 'https://dl.google.com/edgedl/chrome/install/GoogleChromeStandaloneEnterprise.msi',
        ],
        'Google Chrome 64' => [
            'download' => 'https://www.google.com/chrome/',
            'file' => 'https://dl.google.com/edgedl/chrome/install/GoogleChromeStandaloneEnterprise64.msi',
        ],
        'PuTTY 32' => [
            'download' => 'https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html',
            'file' => 'https://the.earth.li/~sgtatham/putty/latest/w32/putty.exe',
        ],
        'PuTTY 64' => [
            'download' => 'https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html',
            'file' => 'https://the.earth.li/~sgtatham/putty/latest/w64/putty.exe',
        ],
        'Foobar2000' => [
            'download' => 'https://www.foobar2000.org/download',
            'xpath' => '/html/body/div[2]/div/div[2]/a[1]',
            'xpath2' => '/html/body/div[2]/div/p[2]/a',
        ],
        'MPC-HC 32' => [
            'download' => 'https://github.com/clsid2/mpc-hc/releases/latest',
            'xpath' => '//*[@id="repo-content-pjax-container"]/div/div/div[2]/div[1]/details/div/div/ul/li[3]/a',
        ],
        'MPC-HC 64' => [
            'download' => 'https://github.com/clsid2/mpc-hc/releases/latest',
            'xpath' => '////*[@id="repo-content-pjax-container"]/div/div/div[2]/div[1]/details/div/div/ul/li[1]/a',
        ],
        'WinRAR 32' => [
            'download' => 'https://www.rarlab.com/download.htm',
            'xpath' => '/html/body/table/tr/td[2]/table[7]/tr[2]/td[1]/a',
            //'xpath2' => '/html/body/table/tr/td[2]/table[3]/tr[2]/td[1]/a',
        ],
        'WinRAR 64' => [
            'download' => 'https://www.rarlab.com/download.htm',
            'xpath' => '/html/body/table/tr/td[2]/table[7]/tr[3]/td[1]/a',
            //'xpath2' => '/html/body/table/tr/td[2]/table[3]/tr[3]/td[1]/a',
        ],
        'Sumatra PDF 32' => [
            'download' => 'https://www.sumatrapdfreader.org/download-free-pdf-viewer',
            'xpath' => '//*[@id="center"]/div/table[2]/tbody/tr[1]/td[2]/a',
        ],
        'Sumatra PDF 64' => [
            'download' => 'https://www.sumatrapdfreader.org/download-free-pdf-viewer',
            'xpath' => '//*[@id="center"]/div/table[1]/tbody/tr[1]/td[2]/a',
        ],
        'Beyond Compare' => [
            'download' => 'https://www.scootersoftware.com/download.php?zz=kb_dl4_winalternate',
            'xpath' => '//*[@id="content"]/p[4]/a',
        ],
        'PhpStorm' => [
            'download' => 'https://www.jetbrains.com/phpstorm/download/',
            'json' => 'https://data.services.jetbrains.com/products/releases?code=PS&latest=true&type=release',
            'jpath' => 'PS,0,downloads,windows,link',
        ],
        'Mozilla Thunderbird 64' => [
            'download' => 'https://www.thunderbird.net/en-US/thunderbird/all/',
            'file' => 'https://download.mozilla.org/?product=thunderbird-latest-ssl&os=win64&lang=nl',
        ],
        'Mozilla Thunderbird 64 MSI' => [
            'download' => 'https://www.thunderbird.net/en-US/thunderbird/all/',
            'file' => 'https://download.mozilla.org/?product=thunderbird-msi-latest-ssl&os=win64&lang=nl',
        ],

        'Mozilla Firefox 64' => [
            'download' => 'https://www.mozilla.org/en-US/firefox/all/',
            'file' => 'https://download.mozilla.org/?product=firefox-latest-ssl&os=win64&lang=nl',
        ],
        'Mozilla Firefox 64 MSI' => [
            'download' => 'https://www.mozilla.org/en-US/firefox/all/',
            'file' => 'https://download.mozilla.org/?product=firefox-msi-latest-ssl&os=win64&lang=nl',
        ],

        //        'Navicat for MySQL' => [
        //            'download' => 'https://navicat.com/en/download/navicat-for-mysql',
        //            'file' => 'https://navicat.com/download/direct-download?product=navicat_mysql_en_x64.exe&location=1',
        //            'xpath' => '*[@id="win"]/div[1]/div[1]/a',
        //            'xpath2' => '/html/body/div[1]/div[6]/div/div/div[2]/div[1]/div/p[1]/a',
        //        ],

        'Transmission Remote GUI 1' => [
            'download' => 'https://sourceforge.net/projects/transgui/files/',
            'xpath' => '//*[@id="files_list"]/tbody/tr[1]/th/a',
            'xpath2' => '//*[@id="files_list"]/tbody/tr[1]/th/a',
        ],
        'Transmission Remote GUI 2' => [
            'download' => 'https://github.com/transmission-remote-gui/transgui/releases/latest',
            'xpath' => '//*[@id="repo-content-pjax-container"]/div/div/div[2]/div[1]/details/div/div/ul/li[6]/a',
        ],

        'KeePass 1.xx' => [
            'download' => 'https://sourceforge.net/projects/keepass/files/KeePass%201.x/',
            'xpath' => '//*[@id="files_list"]/tbody/tr[1]/th/a',
            'xpath2' => '//*[@id="files_list"]/tbody/tr[1]/th/a',
        ],
        'KeePass 2.xx' => [
            'download' => 'https://sourceforge.net/projects/keepass/files/KeePass%202.x/',
            'xpath' => '//*[@id="files_list"]/tbody/tr[1]/th/a',
            'xpath2' => '//*[@id="files_list"]/tbody/tr[1]/th/a',
        ],

        'Windows 10 Media Creation Tool' => [
            'download' => 'https://www.microsoft.com/software-download/windows10',
            'file' => 'https://go.microsoft.com/fwlink/?linkid=691209',
        ],
        'Windows 10 Upgrade Tool' => [
            'download' => 'https://support.microsoft.com/en-us/help/3159635/windows-10-update-assistant',
            'file' => 'https://go.microsoft.com/fwlink/?linkid=799445',
        ],
        'Windows 11 Media Creation Tool' => [
            'download' => 'https://www.microsoft.com/nl-nl/software-download/windows11',
            'file' => 'https://go.microsoft.com/fwlink/?linkid=2156295',
        ],
        'Windows 11 Upgrade Tool' => [
            'download' => 'https://www.microsoft.com/nl-nl/software-download/windows11',
            'file' => 'https://go.microsoft.com/fwlink/?linkid=2171764',
        ],
        'Microsoft Windows and Office ISO Download Tool' => [
            'download' => 'https://www.heidoc.net/joomla/technology-science/microsoft/67-microsoft-windows-and-office-iso-download-tool',
            'file' => 'https://www.heidoc.net/php/Windows%20ISO%20Downloader.exe',
        ],
    ];

    private CacheManager $cache;
    private Factory $client;

    public function __construct(CacheManager $cache, Factory $http)
    {
        $this->client = $http;
        $this->cache = $cache;
    }

    public function cacheHeaders(string $url)
    {
        return $this->cache->remember('get_headers'.$url, self::CACHE_TTL, function () use ($url) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 2, // seconds
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ]);

            $result = @get_headers($url, true, $context);
            if (false === $result) {
                throw new Exception('call failed: '.$url);
            }

            return array_change_key_case($result, CASE_LOWER);
        });
    }

    public function cachePage(string $url)
    {
        return $this->cache->remember('page'.$url, self::CACHE_TTL, function () use ($url) {
            $context = stream_context_create([
                'http' => [
                    'follow_location' => true,
                    'timeout' => 2, // seconds
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ]);

            return @file_get_contents($url, false, $context);
        });
    }

    public function cachePageXpath(string $url, string $xpath): DOMNodeList
    {
        $page = $this->cachePage($url);
        if (false === $page) {
            throw new Exception('failed to get page: '.$url);
        }
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($page);
        $domXpath = new DOMXpath($doc);

        $res = $domXpath->query($xpath);
        if (!$res) {
            throw new Exception('failed to get xpath: '.$xpath.' from url: '.$url);
        }

        return $res;
    }

    public function index()
    {
        $items = $this->cache->remember('meuktracker', self::CACHE_TTL, function () {
            $items = $this->loopProducts();

            return array_filter($items);
        });

        return view('meuktracker/index', ['items' => $items]);
    }

    public function loopProducts()
    {
        $items = [];
        foreach ($this->products as $name => $product) {
            $items[] = $this->getProduct($name, $product);
        }

        return $items;
    }

    public function getProduct($name, $product)
    {
        if (!empty($product['json'])) {
            $product['file'] = $this->getFileFromJson($product['json'], $product['jpath']);
        }

        if (!empty($product['download'])) {
            if (!empty($product['xpath'])) {
                $product['file'] = $this->getFileFromXpath($product['download'], $product['xpath']);
                if (!empty($product['xpath2'])) {
                    $product['file'] = $this->getFileFromXpath($product['file'], $product['xpath2']);
                }
            }
        }

        if (empty($product['file'])) {
            throw new Exception('no file found for '.$name);
        }

        $headers = $this->cacheHeaders($product['file']);
        if (!empty($headers['location'])) {
            if (\is_array($headers['location'])) {
                $headers['location'] = end($headers['location']);
            }
            $product['file'] = (string) $headers['location'];
        }

        $obj = new \stdClass();
        $obj->category = 'Software';
        $obj->catId = 'Software';
        $obj->version = $this->extractVersionFromUrl($product['file']);
        $obj->name = $name;
        $obj->date = date('d-m-Y', (int) strtotime(last((array) $headers['last-modified'])));
        $obj->size = $this->formatBytes((int) last((array) $headers['content-length']));
        $obj->file = $product['file'];
        $obj->url = $product['download'] ?? '';
        $obj->product = $product;
        $obj->headers = $headers;

        return $obj;
    }

    public function getFileFromJson(string $url, string $jpath)
    {
        $json = $this->cachePage($url);
        $json = json_decode($json, true);
        $jpath = explode(',', $jpath);

        foreach ($jpath as $j) {
            $json = $json[$j] ?? null;
        }

        return $json;
    }

    public function getFileFromXpath(string $url, string $xpath)
    {
        $elements = $this->cachePageXpath($url, $xpath);
        foreach ($elements as $element) {
            $file = $element->attributes->getNamedItem('href')->nodeValue;
            if (false === filter_var($file, FILTER_VALIDATE_URL)) {
                $baseUrl = self::getBaseUrl($url);

                return $baseUrl.$file;
            }

            return $file;
        }

        return null;
    }

    /**
     * @see http://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes/2510540#2510540
     */
    public function formatBytes(int $size, int $precision = 2): string
    {
        $base = log((float) $size, 1024);
        $suffixes = ['', 'KB', 'MB', 'GB', 'TB'];

        return round(1024 ** ($base - floor($base)), $precision).' '.$suffixes[(int) floor($base)];
    }

    /**
     * preg_match is stupid.
     *
     * @param mixed $input
     * @param mixed $regex
     */
    public static function pregMatch($input, $regex)
    {
        preg_match($regex, $input, $out);

        return @$out[0];
    }

    /**
     * @see http://php.net/manual/en/function.parse-url.php#106731
     *
     * @param mixed $parsedUrl
     */
    public static function unparseUrl($parsedUrl)
    {
        $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'].'://' : '';
        $host = $parsedUrl['host'] ?? '';
        $port = isset($parsedUrl['port']) ? ':'.$parsedUrl['port'] : '';
        $user = $parsedUrl['user'] ?? '';
        $pass = isset($parsedUrl['pass']) ? ':'.$parsedUrl['pass'] : '';
        $pass = ($user || $pass) ? $pass.'@' : '';
        $path = $parsedUrl['path'] ?? '';
        $query = isset($parsedUrl['query']) ? '?'.$parsedUrl['query'] : '';
        $fragment = isset($parsedUrl['fragment']) ? '#'.$parsedUrl['fragment'] : '';

        return $scheme.$user.$pass.$host.$port.$path.$query.$fragment;
    }

    public static function getBaseUrl($url)
    {
        $urlParts = parse_url($url);
        unset($urlParts['path'], $urlParts['query']);

        return self::unparseUrl($urlParts);
    }

    public static function getFileName($url)
    {
        $urlParts = (string) parse_url($url, PHP_URL_PATH);

        return last(explode('/', $urlParts));
    }

    /**
     * can be improved.
     */
    private function extractVersionFromUrl(string $url)
    {
        $filename = urldecode((string) parse_url($url, PHP_URL_PATH));
        $parts = explode('/', $filename);
        $filename = last($parts);

        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
        if (!empty($query['response-content-disposition'])) {
            $filename = explode('filename=', $query['response-content-disposition'])[1];
        }

        try {
            return $this->extractVersionFromFile($filename);
        } catch (Exception) {
            try {
                return $this->extractVersionFromFile($url);
            } catch (Exception) {
                return 'latest';
            }
        }
    }

    private function extractVersionFromFile($filename)
    {
        $result = $this->pregMatch($filename, '/(\d{1,4}\.\d{1,2}.\d{1,2}.\d{1,5})+/'); // eg: x.x.x.x
        if (!empty($result)) {
            return $result;
        }

        $result = $this->pregMatch($filename, '/(\d{1,4}\.\d{1,2}.\d{1,2})+/'); // eg: x.x.x
        if (!empty($result)) {
            return $result;
        }

        $result = $this->pregMatch($filename, '/(\d{1,4}\.\d{1,2})+/'); // eg: x.x / xx.x / x.xx / xx.xx
        if (!empty($result)) {
            return $result;
        }

        $result = $this->pregMatch($filename, '/(\d{4,5})+/'); // eg xxxx / xxxxx
        if (!empty($result)) {
            return $result;
        }

        $result = $this->pregMatch($filename, '/(\d{2}[H|b]\d{1})+/'); // eg 20H2 60b2
        if (!empty($result)) {
            return $result;
        }

        $result = $this->pregMatch($filename, '/(\d{3})+/'); // eg xxx
        if (!empty($result)) {
            return $result[0].'.'.$result[1].$result[2];
        }

        throw new Exception('nothing found');
    }
}
