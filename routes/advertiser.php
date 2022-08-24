<?php

use App\Http\Controllers\Users\Advertisers\AdvertiserController;
use App\Http\Controllers\Users\Advertisers\Create\FollowController;
use App\Http\Controllers\Users\Advertisers\Create\CommentController;
use App\Http\Controllers\Users\Advertisers\Create\LikeController;
use App\Http\Livewire\Ads\Views\CreateAds;
use App\Http\Livewire\Ads\Views\MyAdsList;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('advertiser')->group(function () {
    Route::get('create', [AdvertiserController::class, 'dashboard'])->name('advertisers.dashboard');

    Route::get('/tambah/iklan-follower', [FollowController::class, 'index'])->name('iklan.add.follower');
    Route::post('/tambah/iklan-follower', [FollowController::class, 'create'])->name('follow.create');

    Route::get('/tambah/iklan-komentar', [CommentController::class, 'index'])->name('iklan.add.komentar');
    Route::post('/tambah/iklan-komentar', [CommentController::class, 'create'])->name('comment.create');

    Route::get('/tambah/iklan-like', [LikeController::class, 'index'])->name('iklan.add.like');
    Route::post('/tambah/iklan-like', [LikeController::class, 'create'])->name('like.create');

    Route::get('/tambah/iklan-posting', [\App\Http\Controllers\Users\Advertisers\Create\PostingController::class, 'index'])->name('iklan.add.posting');
    Route::post('/tambah/iklan-posting', [\App\Http\Controllers\Users\Advertisers\Create\PostingController::class, 'create'])->name('posting.create');

    Route::get('/tambah/iklan-subscribe', [\App\Http\Controllers\Users\Advertisers\Create\SubcribeController::class, 'index'])->name('iklan.add.subscribe');
    Route::post('/tambah/iklan-subscribe', [\App\Http\Controllers\Users\Advertisers\Create\SubcribeController::class, 'create'])->name('subscribe.create');

    Route::get('/tambah/iklan-view', [\App\Http\Controllers\Users\Advertisers\Create\ViewsController::class, 'index'])->name('iklan.add.views');
    Route::post('/tambah/iklan-view', [\App\Http\Controllers\Users\Advertisers\Create\ViewsController::class, 'create'])->name('views.create');

    Route::get('/tambah/iklan-question', [AdvertiserController::class, 'addQuestion'])->name('iklan.add.question');

    Route::get('/iklan-question', [AdvertiserController::class, 'viewsQuestion'])->name('iklan.view.question');
    Route::get('/iklan-posting', [AdvertiserController::class, 'viewsPosting'])->name('iklan.view.posting');
    Route::get('/iklan-follower', [AdvertiserController::class, 'viewsFollower'])->name('iklan.view.follower');
    Route::get('/iklan-view', [AdvertiserController::class, 'indexView'])->name('iklan.view.views');
    Route::get('/iklan-subscribe', [AdvertiserController::class, 'indexSubscribe'])->name('iklan.view.subscribe');
    Route::get('/iklan-like', [AdvertiserController::class, 'indexLike'])->name('iklan.view.like');
    Route::get('/iklan-komentar', [AdvertiserController::class, 'indexKomentar'])->name('iklan.view.komentar');

    Route::get('buat-iklan', CreateAds::class)->name('ads.create');
    Route::get('daftar-iklan-{type}', MyAdsList::class)->name('iklan.myads');
});
