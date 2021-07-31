<?php

declare(strict_types=1);

namespace App\Http\Controllers;

/**
 * @see https://www.programmersought.com/article/46964350323/
 */
class NavicatPassword
{
    protected $version = 0;
    protected $aesKey = 'libcckeylibcckey';
    protected $aesIv = 'libcciv libcciv ';
    protected $blowString = '3DC5CA39';
    protected $blowKey;
    protected $blowIv;

    public function __construct($version = 12)
    {
        $this->version = $version;
        $this->blowKey = sha1('3DC5CA39', true);
        $this->blowIv = hex2bin('d9c7c3c8870d64bd');
    }

    public function encrypt($string)
    {
        switch ($this->version) {
            case 11:
                return $this->encryptEleven($string);

            default:
                return $this->encryptTwelve($string);
        }
    }

    public function decrypt($string)
    {
        switch ($this->version) {
            case 11:
                return $this->decryptEleven($string);

            default:
                return $this->decryptTwelve($string);
        }
    }

    protected function encryptEleven($string)
    {
        $round = (int) (floor(\strlen($string) / 8));
        $leftLength = \strlen($string) % 8;
        $result = '';
        $currentVector = $this->blowIv;

        for ($i = 0; $i < $round; ++$i) {
            $temp = $this->encryptBlock($this->xorBytes(substr($string, 8 * $i, 8), $currentVector));
            $currentVector = $this->xorBytes($currentVector, $temp);
            $result .= $temp;
        }

        if ($leftLength) {
            $currentVector = $this->encryptBlock($currentVector);
            $result .= $this->xorBytes(substr($string, 8 * $i, $leftLength), $currentVector);
        }

        return strtoupper(bin2hex($result));
    }

    protected function encryptBlock($block)
    {
        return openssl_encrypt($block, 'BF-ECB', $this->blowKey, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
    }

    protected function decryptBlock($block)
    {
        return openssl_decrypt($block, 'BF-ECB', $this->blowKey, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
    }

    protected function xorBytes($str1, $str2)
    {
        $result = '';
        for ($i = 0; $i < \strlen($str1); ++$i) {
            $result .= \chr(\ord($str1[$i]) ^ \ord($str2[$i]));
        }

        return $result;
    }

    protected function encryptTwelve($string)
    {
        $result = openssl_encrypt($string, 'AES-128-CBC', $this->aesKey, OPENSSL_RAW_DATA, $this->aesIv);

        return strtoupper(bin2hex($result));
    }

    protected function decryptEleven($upperString)
    {
        $string = hex2bin(strtolower($upperString));

        $round = (int) (floor(\strlen($string) / 8));
        $leftLength = \strlen($string) % 8;
        $result = '';
        $currentVector = $this->blowIv;

        for ($i = 0; $i < $round; ++$i) {
            $encryptedBlock = substr($string, 8 * $i, 8);
            $temp = $this->xorBytes($this->decryptBlock($encryptedBlock), $currentVector);
            $currentVector = $this->xorBytes($currentVector, $encryptedBlock);
            $result .= $temp;
        }

        if ($leftLength) {
            $currentVector = $this->encryptBlock($currentVector);
            $result .= $this->xorBytes(substr($string, 8 * $i, $leftLength), $currentVector);
        }

        return $result;
    }

    protected function decryptTwelve($upperString)
    {
        $string = hex2bin(strtolower($upperString));

        return openssl_decrypt($string, 'AES-128-CBC', $this->aesKey, OPENSSL_RAW_DATA, $this->aesIv);
    }
}
