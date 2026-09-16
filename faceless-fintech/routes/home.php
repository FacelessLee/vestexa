<?php

use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

//cron url
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');
//Front Pages Route
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('terms', [HomePageController::class, 'terms'])->name('terms');
Route::get('privacy', [HomePageController::class, 'privacy'])->name('privacy');
Route::get('about', [HomePageController::class, 'about'])->name('about');
Route::get('contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('grants', [HomePageController::class, 'grants'])->name('grants');
Route::get('business', [HomePageController::class, 'business'])->name('business');
Route::get('apps', [HomePageController::class, 'app'])->name('apps');
Route::get('loans', [HomePageController::class, 'loans'])->name('loans');
Route::get('send-money', [HomePageController::class, 'loans'])->name('loans');
Route::get('cards', [HomePageController::class, 'cards'])->name('card');
Route::get('personal', [HomePageController::class, 'personal'])->name('personal');
Route::get('chart', [HomePageController::class, 'personal'])->name('personal');
Route::get('verify',[HomePageController::class,'verify'])->name('verify');
Route::post('homesendcontact', [HomePageController::class, 'homesendcontact'] )->name('homesendcontact');
Route::post('codeverify', [HomePageController::class, 'codeverify'])->name('codeverify');
Route::get('terms-of-service', [HomePageController::class, 'terms'])->name('terms');
Route::get('alerts', [HomePageController::class, 'business'])->name('business');
