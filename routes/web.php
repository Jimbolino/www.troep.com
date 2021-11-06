<?php

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\DecryptNavicatController;
use App\Http\Controllers\FileListController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\Meuktracker\Meuktracker;
use App\Http\Controllers\Meuktracker\Office;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\StartpageController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\ViewSourceController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// @phan-file-suppress PhanStaticCallToNonStatic

Route::get('/', [WelcomeController::class, 'index']);
Route::get('mailmij.php', [ContactController::class, 'show'])->middleware('csrf');
Route::post('mailmij.php', [ContactController::class, 'send'])->middleware('csrf');
Route::get('tools/time.php', [TimeController::class, 'show']);
Route::get('ip', [IpController::class, 'show']);
Route::any('tools/viewsource.php', [ViewSourceController::class, 'show']);
Route::get('startpage.php', [StartpageController::class, 'show']);

// cacheable routes
Route::middleware('cache.headers:public;max_age=3600')->group(function (): void {
    Route::get('tha-music.htm', [ProxyController::class, 'get']);
    Route::get('linux.htm', [ProxyController::class, 'get']);
    Route::get('bookmarks.htm', [ProxyController::class, 'get']);
    Route::get('images/{file}', [ProxyController::class, 'get'])->where('file', '.*');

    Route::get('troep', [FileListController::class, 'index']);
    Route::get('troep/{file}', [FileListController::class, 'show'])->where('file', '.*');

    Route::get('navicat', [DecryptNavicatController::class, 'show']);
    Route::get('navicat/decrypt/{version}/{password}', [DecryptNavicatController::class, 'decrypt']);

    Route::get('meuktracker', [Meuktracker::class, 'index']);
    Route::get('meuktracker/office', [Office::class, 'show']);
});

Route::get('debug', [DebugController::class, 'get']);
Route::get('debug/config', [DebugController::class, 'config']);
Route::get('debug/cookie', [DebugController::class, 'cookie']);
Route::get('debug/phpinfo', [DebugController::class, 'phpinfo']);
Route::get('debug/request', [DebugController::class, 'request']);
Route::get('debug/server', [DebugController::class, 'server']);
