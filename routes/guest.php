<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;

Route::get('/iklan', function () {
    return view('guests.iklan');
})->name('iklan');

Route::get('/view', function () {
    return view('guests.viewer');
})->name('viewer');


Route::get('/tor', function () {
    return view('guests.tos');
})->name('tos');

Route::get('/tentang_kami', function () {
    return view('guests.tentang_kami');
})->name('tentang');

Route::get('/kontak', function () {
    return view('guests.kontak');
})->name('kontak');

Route::get('/', function () {
    return view('guests.home');
})->name('dashboard');


Route::get('/blog', function () {
    $blogs = Blog::all();
    return view('guests.blog', compact('blogs'));
})->name('blog');
Route::get('/blog/{slug}', function ($slug) {
    $slug = explode('-', $slug);
    $blog = Blog::find(end($slug));
    if ($blog) {
        return view('guests.detail-blog', compact('blog'));
    }
    return redirect(route('dashboard'));
})->name('blog-detail');
