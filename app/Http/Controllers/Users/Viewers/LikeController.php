<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\LikeAds;
use App\Models\Package;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-like', [
            'likes' => Ads::where('type', Package::LIKE)->paginate(10)->withQueryString(),
        ]);
    }
}
