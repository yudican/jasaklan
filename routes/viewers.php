<?php

use App\Http\Controllers\Users\Viewers\ViewerController;
use App\Http\Livewire\Ads\Revenue;
use App\Http\Livewire\Ads\Views\AdsList;
use App\Http\Livewire\Ads\Views\MyTicket;
use App\Http\Livewire\Ads\Views\ViewVideoDetail;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('viewers')->as('viewers.')->group(function () {
    // Route::get('iklan-view-question', [\App\Http\Controllers\Users\Viewers\ViewQuestionController::class, 'index'])->name('question');
    // Route::get('iklan-follow', [\App\Http\Controllers\Users\Viewers\FollowController::class, 'index'])->name('follow');
    // Route::get('iklan-posting', [\App\Http\Controllers\Users\Viewers\PostingController::class, 'index'])->name('posting');

    // Route::get('iklan-like', [\App\Http\Controllers\Users\Viewers\LikeController::class, 'index'])->name('like');
    // Route::get('iklan-komentar', [\App\Http\Controllers\Users\Viewers\CommentController::class, 'index'])->name('komentar');

    // Route::get('iklan-subscribe', [\App\Http\Controllers\Users\Viewers\SubscribeController::class, 'index'])->name('subscribe');
    Route::get('check/{ads}', [\App\Http\Controllers\Users\Viewers\TicketController::class, 'getAsSession'])->name('ticket.session');

    Route::get('ticket', MyTicket::class)->name('ticket.index');
    // Route::get('ticket', [\App\Http\Controllers\Users\Viewers\TicketController::class, 'index'])->name('ticket.index');
    Route::post('ticket', [\App\Http\Controllers\Users\Viewers\TicketController::class, 'create'])->name('ticket.create');

    Route::get('/revenue', Revenue::class)->name('revenue.index');
    Route::post('/revenue/transfer', [\App\Http\Controllers\Users\Viewers\RevenueController::class, 'transfer'])->name('revenue.transfer');

    // Route::get('iklan-view-{type}', [\App\Http\Controllers\Users\Viewers\ViewController::class, 'index'])->name('view');
    Route::get('iklan-{type}', AdsList::class)->name('ads.list');
    Route::get('iklan-view/{ads_id}', ViewVideoDetail::class)->name('view.detail');
});
