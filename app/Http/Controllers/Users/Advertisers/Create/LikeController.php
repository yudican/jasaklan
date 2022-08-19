<?php

namespace App\Http\Controllers\Users\Advertisers\Create;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\FollowAds;
use App\Models\LikeAds;
use App\Models\Package;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        return view('users.advertisers.creates.iklan-like', [
            'user' => auth()->user(),
            'packages' => Package::where('type', Package::LIKE)->get(),
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
            'title'));

        $followAds->user_id = $request->user()->id;
        $followAds->amount  = $package->benefits;
        $followAds->type  = Package::LIKE;
        $followAds->status  = LikeAds::ACTIVE;
        $followAds->commission  = $package->commission > 0 ?: Ads::LIKE_COM;

        $followAds->saveOrFail();

        $this->storeTransaction($request, $package->price);

        return redirect(route('iklan.view.like'))->with(['status' => 'Berhasil memasang iklan untuk nama akun: ' . $request->account_name]);
    }
}
