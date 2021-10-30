<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Filesystem\FilesystemManager;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileListController extends Controller
{
    private string $dir = 'troep';
    private FilesystemManager $storage;

    public function __construct(FilesystemManager $storage)
    {
        $this->storage = $storage;
    }

    public function show($file)
    {
        $exists = $this->storage->exists($this->dir.'/'.$file);
        if (!$exists) {
            throw new NotFoundHttpException();
        }
        $meta = $this->storage->getMetadata($this->dir.'/'.$file);
        if (false === $meta) {
            $this->dir .= '/'.$file;

            return $this->index();
        }

        $stream = $this->storage->readStream($this->dir.'/'.$file);
        if (!\is_resource($stream)) {
            throw new NotFoundHttpException();
        }

        if ('html' === ($meta['extension'] ?? '')) {
            $meta['mimetype'] = 'text/html';
        }

        $headers = [
            'Content-Type' => $meta['mimetype'] ?? 'text/plain',
            'Content-Length' => $meta['size'],
        ];

        return new StreamedResponse(function () use ($stream): void {
            fpassthru($stream);
        }, 200, $headers);
    }

    public function index()
    {
        $files = $this->storage->listContents($this->dir);

        $extensionToIcon = [
            'exe' => 'binary',
            'gif' => 'image2',
            'htm' => 'text',
            'html' => 'text',
            'jpg' => 'image2',
            'm3u' => 'sound2',
            'mp3' => 'sound2',
            'php' => 'unknown',
            'png' => 'image2',
            'rar' => 'unknown',
            'txt' => 'text',
        ];


        foreach ($files as &$file) {
            if (!empty($file['size'])) {
                $file['size'] = $this->niceSize($file['size']);
            } else {
                $file['size'] = '-';
            }

            if ('dir' === $file['type']) {
                $file['icon'] = 'folder';

                continue;
            }
            $icon = @$extensionToIcon[strtolower($file['extension'] ?? '')];
            $file['icon'] = $icon ?? 'unknown';
        }

        $data = [
            'files' => $files,
            'dir' => $this->dir,
        ];

        return view('filelist', $data);
    }

    private function niceSize($bytes)
    {
        $bytes = (float) $bytes;
        $unit = ['', 'K', 'M', 'G'];
        $exp = (int) floor(log($bytes, 1024)) | 0;
        $amount = $bytes / (1024 ** $exp);
        $len = \strlen((string) floor($amount));
        $precision = (int) !($len > 1);

        return round($amount, $precision).$unit[$exp];
    }
}
