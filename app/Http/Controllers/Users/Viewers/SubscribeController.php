<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use App\Models\SubscribeAds;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-subscribe', [
            'subscribers' => Ads::where('type', Package::SUBSCRIBE)->paginate(10)->withQueryString(),
        ]);
    }
}
