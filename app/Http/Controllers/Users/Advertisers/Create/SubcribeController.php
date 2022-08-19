<?php

namespace App\Http\Controllers\Users\Advertisers\Create;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use App\Models\PostingAds;
use App\Models\SubscribeAds;
use Illuminate\Http\Request;

class SubcribeController extends Controller
{
    public function index()
    {
        return view('users.advertisers.creates.iklan-subscribe', [
            'user' => auth()->user(),
            'packages' => Package::where('type', Package::SUBSCRIBE)->get(),
        ]);
    }

    public function create(Request $request)
    {
        $package = Package::findOrfail($request->package_id);

        if((int) $package->price > $request->user()->balance)
            return back()->withErrors(['status' => 'Saldo kamu tidak mencukupi untuk mengambil paket ini']);

        $subsAds = new Ads();

        $subsAds->fill($request->only(
            'package_id',
            'social_media',
            'photo',
            'url',
            'title',
            'notes'));

        $subsAds->user_id = $request->user()->id;
        $subsAds->amount  = $package->benefits;
        $subsAds->type    = Package::SUBSCRIBE;
        $subsAds->status  = SubscribeAds::ACTIVE;
        $subsAds->commission = $package->commission > 0 ?: Ads::SUBS_COM;

        $subsAds->saveOrFail();

        $this->storeTransaction($request, $package->price);

        return redirect(route('iklan.view.subscribe'))->with(['status' => 'Berhasil memasang iklan untuk nama akun: ' . $request->account_name]);
    }
}
