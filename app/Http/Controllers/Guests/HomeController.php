<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('guests.home');
    }
}
