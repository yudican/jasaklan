<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use App\Models\SubscribeAds;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-follow', [
            'follows' => Ads::where('type', Package::FOLLOWER)->paginate(10)->withQueryString(),
        ]);
    }

    public function getAsSession(SubscribeAds $subscribe)
    {
        return back()->with(['content' => $subscribe]);
    }
}
