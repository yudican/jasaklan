<?php

use App\Http\Controllers\Users\Advertisers\AdvertiserController;
use App\Http\Controllers\Users\Viewers\ViewerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/ref/{referralCode}', function (string $referralCode) {
    return redirect('/register?ref=' . $referralCode);
})->name('redirect.ref');

Route::get('/dashboard', function () {
    return view('guests.home');
})->middleware(['auth'])->name('dashboard');

Route::get('/iklan-view', [AdvertiserController::class, 'indexview']);
Route::get('/iklan-subscribe', [AdvertiserController::class, 'indexsubscribe']);
Route::get('/iklan-like',[AdvertiserController::class, 'indexlike']);
Route::get('/iklan-komentar',[AdvertiserController::class, 'indexkomentar']);

require __DIR__.'/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/advertiser.php';
require __DIR__.'/guest.php';
require __DIR__.'/viewers.php';
require __DIR__.'/admin.php';
