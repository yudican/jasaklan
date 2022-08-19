<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\BlogController;
use App\Http\Livewire\Admin\AlertController as AdminAlertController;
use App\Http\Livewire\Admin\BlogController as AdminBlogController;
use App\Http\Livewire\Admin\TicketController as AdminTicketController;
use App\Http\Livewire\Admin\UserController;
use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return redirect(route('admin.dashboard'));
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('ticket', AdminTicketController::class)->name('ticket');
        Route::get('blog', AdminBlogController::class)->name('blog');
        Route::get('alert', AdminAlertController::class)->name('alert');
        Route::get('user-management', UserController::class)->name('user');
        Route::get('tickets', [TicketController::class, 'index'])->name('ticket.index');
        Route::get('ticket/{ticket}/download', [TicketController::class, 'download'])->name('ticket.download');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::put('tickets/{ticket}/approve', [TicketController::class, 'approve'])->name('ticket.approve');
        Route::put('tickets/{ticket}/decline', [TicketController::class, 'decline'])->name('ticket.decline');

        Route::get('blogs', [BlogController::class, 'index'])->name('blog.index');
        Route::get('blog-add', [BlogController::class, 'create'])->name('blog.create');
        Route::post('blog-store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('blog-delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

        Route::get('alert-edit', [AlertController::class, 'create'])->name('alert.create');
        Route::post('alert-store', [AlertController::class, 'update'])->name('alert.update');
    });

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});
