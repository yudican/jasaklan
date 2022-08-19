<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-views', [
            'views' => Ads::where('type', Package::VIEWS)->paginate(10)->withQueryString(),
        ]);
    }
}
