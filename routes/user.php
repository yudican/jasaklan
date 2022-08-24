<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\Profiles\ProfileController;
use App\Http\Livewire\Ads\MyWallet;

Route::middleware('auth')->group(function () {
    Route::get('user', [ProfileController::class, 'showDashboard'])->name('user.dashboard');
    Route::get('user/referral', [ProfileController::class, 'showReferral'])->name('user.referral');
    Route::get('user/profile', [ProfileController::class, 'showProfile'])->name('user.profile');
    Route::get('user/password', [ProfileController::class, 'showPassword'])->name('user.showPassword');
    Route::get('user/bank', [ProfileController::class, 'showBank'])->name('user.bank');
    Route::get('user/wallet', MyWallet::class)->name('user.wallet');
    Route::get('deposit', [ProfileController::class, 'showDeposit'])->name('advertiser.deposit');
    Route::get('withdraw', [ProfileController::class, 'showWithdraw'])->name('user.withdraw');

    Route::post('deposit', [ProfileController::class, 'createDeposit'])->name('deposit.create');
    Route::post('withdraw', [ProfileController::class, 'createWithdraw'])->name('withdraw.create');


    Route::put('user/profile/{user}', [ProfileController::class, 'updateProfile'])->name('user.update');
    Route::put('user/password/{user}', [ProfileController::class, 'updatePassword'])->name('user.password');
    Route::put('user/{user}/bank', [ProfileController::class, 'updateBank'])->name('bank.update');
});

Route::post('deposit/status/handle', [ProfileController::class, 'handleDepositStatus'])->name('deposit.handle');
