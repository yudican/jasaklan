<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-posting', [
            'posts' => Ads::where('type', Package::POSTING)->paginate(10)->withQueryString(),
        ]);
    }
}
