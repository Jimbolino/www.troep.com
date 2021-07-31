<?php

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\DecryptNavicatController;
use App\Http\Controllers\FileListController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\StartpageController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\ViewSourceController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// @phan-file-suppress PhanStaticCallToNonStatic

Route::get('/', [WelcomeController::class, 'index']);
Route::get('startpage.php', [StartpageController::class, 'show']);
Route::get('mailmij.php', [ContactController::class, 'show']);
Route::post('mailmij.php', [ContactController::class, 'send']);

Route::get('ip', [IpController::class, 'show']);
Route::get('tools/time.php', [TimeController::class, 'show']);
Route::any('tools/viewsource.php', [ViewSourceController::class, 'show']);

Route::get('tha-music.htm', [ProxyController::class, 'get']);
Route::get('linux.htm', [ProxyController::class, 'get']);
Route::get('bookmarks.htm', [ProxyController::class, 'get']);
Route::get('images/{file}', [ProxyController::class, 'get'])->where('file', '.*');

Route::get('troep', [FileListController::class, 'index']);
Route::get('troep/{file}', [FileListController::class, 'show'])->where('file', '.*');

Route::get('debug', [DebugController::class, 'get']);

Route::get('navicat', [DecryptNavicatController::class, 'show']);
Route::get('navicat/decrypt/{version}/{password}', [DecryptNavicatController::class, 'decrypt']);
