<?php

namespace App\Http\Controllers\Users\Advertisers\Create;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\FollowAds;
use App\Models\Package;
use App\Models\PostingAds;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    public function index()
    {
        return view('users.advertisers.creates.iklan-posting', [
            'user' => auth()->user(),
            'packages' => Package::where('type', Package::POSTING)->get(),
        ]);
    }

    public function create(Request $request)
    {
        $package = Package::findOrfail($request->package_id);

        if((int) $package->price > $request->user()->balance)
            return back()->withErrors(['status' => 'Saldo kamu tidak mencukupi untuk mengambil paket ini']);

        $postAds = new Ads();

        $postAds->fill($request->only(
            'package_id',
            'social_media',
            'photo',
            'url',
            'account_name',
            'notes'));

        $postAds->user_id = $request->user()->id;
        $postAds->amount  = $package->benefits;
        $postAds->title   = '';
        $postAds->url     = '';
        $postAds->type    = Package::POSTING;
        $postAds->status  = PostingAds::ACTIVE;
        $postAds->commission  = $package->commission > 0 ?: Ads::POST_COM;

        $postAds->saveOrFail();

        $this->storeTransaction($request, $package->price);

        return redirect(route('iklan.view.posting'))->with(['status' => 'Berhasil memasang iklan untuk nama akun: ' . $request->account_name]);
    }
}
