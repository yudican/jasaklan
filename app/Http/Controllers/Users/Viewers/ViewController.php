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
            'views' => Ads::where('type', Package::VIEWS)->whereHas('package.adsType', function ($query) {
                $query->where('type_action', 'view')->where('user_id', '!=', auth()->user()->id);
            })->whereDoesntHave('userViews', function ($query) {
                $query->where('users.id', auth()->user()->id);
            })->paginate(10)->withQueryString(),
            'view_tickets' => Ads::where('type', Package::VIEWS)->whereHas('package.adsType', function ($query) {
                $query->where('type_action', 'ticket')->where('user_id', '!=', auth()->user()->id);
            })->whereDoesntHave('tickets', function ($query) {
                $query->where('tickets.user_id', auth()->user()->id);
            })->paginate(10)->withQueryString(),
        ]);
    }
}
