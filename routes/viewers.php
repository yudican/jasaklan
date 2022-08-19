<?php

use App\Http\Controllers\Users\Viewers\ViewerController;
use Illuminate\Support\Facades\Route;

Route::prefix('viewers')->as('viewers.')->group(function () {
    Route::get('iklan-view-question', [\App\Http\Controllers\Users\Viewers\ViewQuestionController::class, 'index'])->name('question');
    Route::get('iklan-follow', [\App\Http\Controllers\Users\Viewers\FollowController::class, 'index'])->name('follow');
    Route::get('iklan-posting', [\App\Http\Controllers\Users\Viewers\PostingController::class, 'index'])->name('posting');

    Route::get('iklan-like', [\App\Http\Controllers\Users\Viewers\LikeController::class, 'index'])->name('like');
    Route::get('iklan-komentar', [\App\Http\Controllers\Users\Viewers\CommentController::class, 'index'])->name('komentar');

    Route::get('iklan-subscribe', [\App\Http\Controllers\Users\Viewers\SubscribeController::class, 'index'])->name('subscribe');
    Route::get('check/{ads}', [\App\Http\Controllers\Users\Viewers\TicketController::class, 'getAsSession'])->name('ticket.session');

    Route::get('ticket', [\App\Http\Controllers\Users\Viewers\TicketController::class, 'index'])->name('ticket.index');
    Route::post('ticket', [\App\Http\Controllers\Users\Viewers\TicketController::class, 'create'])->name('ticket.create');

    Route::get('/revenue', [\App\Http\Controllers\Users\Viewers\RevenueController::class, 'index'])->name('revenue.index');
    Route::post('/revenue/transfer', [\App\Http\Controllers\Users\Viewers\RevenueController::class, 'transfer'])->name('revenue.transfer');

    Route::get('iklan-view', [\App\Http\Controllers\Users\Viewers\ViewController::class, 'index'])->name('view');
});
