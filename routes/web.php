<?php

use App\Http\Controllers\Api\PasswordGenerator;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\Users\Advertisers\AdvertiserController;
use App\Http\Controllers\Users\Viewers\ViewerController;
use App\Http\Livewire\Guest\ContactUs;
use App\Http\Livewire\Guest\Disclaimer;
use App\Http\Livewire\Guest\PrivacyPolicy;
use App\Http\Livewire\Guest\TermOfConditions;
use App\Http\Livewire\Guest\TermOfService;
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
Route::get('/iklan-like', [AdvertiserController::class, 'indexlike']);
Route::get('/iklan-komentar', [AdvertiserController::class, 'indexkomentar']);

Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy.policy');
Route::get('/disclaimer', Disclaimer::class)->name('disclaimer');
Route::get('/term-of-service', TermOfService::class)->name('term.of.service');
Route::get('/term-of-conditions', TermOfConditions::class)->name('term.of.condition');
Route::get('/contact-us', ContactUs::class)->name('contact.us');
Route::get('/refund-and-return', ContactUs::class)->name('return.refund');

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/advertiser.php';
require __DIR__ . '/guest.php';
require __DIR__ . '/viewers.php';
require __DIR__ . '/admin.php';
