<?php

namespace App\Http\Controllers\Users\Advertisers\Create;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\FollowAds;
use App\Models\Package;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function index()
    {
        return view('users.advertisers.creates.iklan-follower', [
            'user' => auth()->user(),
            'packages' => Package::where('type', Package::FOLLOWER)->get(),
        ]);
    }

    public function create(Request $request)
    {
        $package = Package::findOrfail($request->package_id);

        if((int) $package->price > $request->user()->balance)
            return back()->withErrors(['status' => 'Saldo kamu tidak mencukupi untuk mengambil paket ini']);

        $followAds = new Ads();

        $followAds->fill($request->only(
            'package_id',
            'social_media',
            'url',
            'account_name',
            'notes'));

        $followAds->title   = $request->account_name;
        $followAds->user_id = $request->user()->id;
        $followAds->amount  = $package->benefits;
        $followAds->type    = Package::FOLLOWER;
        $followAds->status  = FollowAds::ACTIVE;
        $followAds->commission  = $package->commission > 0 ?: Ads::FOLLOW_COM;

        $followAds->saveOrFail();

        $this->storeTransaction($request, $package->price);

        return redirect(route('iklan.view.follower'))->with(['status' => 'Berhasil memasang iklan untuk nama akun: ' . $request->account_name]);
    }
}
