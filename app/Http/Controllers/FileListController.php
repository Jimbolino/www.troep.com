<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Filesystem\FilesystemManager;
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
        if (!$this->storage->exists($this->dir.'/'.$file)) {
            throw new NotFoundHttpException();
        }

        if ($this->storage->directoryExists($this->dir.'/'.$file)) {
            $this->dir .= '/'.$file;

            return $this->index();
        }

        $headers = [];
        if ('html' === pathinfo($file, \PATHINFO_EXTENSION)) {
            $headers['Content-Type'] = 'text/html';
        }

        return $this->storage->response($this->dir.'/'.$file, null, $headers);
    }

    public function index()
    {
        $listContents = $this->storage->listContents($this->dir);

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

        $files = [];
        foreach ($listContents as $file) {
            if ($file['path'] === $this->dir) {
                continue;
            }
            if ('dir' === $file['type']) {
                $icon = 'folder';
            } else {
                $icon = $extensionToIcon[strtolower(pathinfo($file['path'], \PATHINFO_EXTENSION))] ?? 'unknown';
            }

            $files[] = [
                'basename' => pathinfo($file['path'], \PATHINFO_BASENAME),
                'icon' => $icon,
                'path' => $file['path'],
                'size' => $this->niceSize($file['fileSize'] ?? null),
                'timestamp' => $file['lastModified'],
            ];
        }

        $data = [
            'files' => $files,
            'dir' => $this->dir,
        ];

        return view('filelist', $data);
    }

    private function niceSize($bytes): string
    {
        if (null === $bytes) {
            return '-';
        }

        $bytes = (float) $bytes;
        $unit = ['', 'K', 'M', 'G'];
        $exp = (int) floor(log($bytes, 1024)) | 0;
        $amount = $bytes / (1024 ** $exp);
        $len = \strlen((string) floor($amount));
        $precision = (int) !($len > 1);

        return round($amount, $precision).$unit[$exp];
    }
}
