<?php

namespace App\Http\Controllers\Users\Advertisers\Create;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use App\Models\SubscribeAds;
use App\Models\ViewAds;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function index()
    {
        return view('users.advertisers.creates.iklan-view', [
            'user' => auth()->user(),
            'packages' => Package::where('type', Package::VIEWS)->get(),
        ]);
    }

    public function create(Request $request)
    {
        $package = Package::findOrfail($request->package_id);

        $getTotalPayment = (int) $package->price * (int) $request->views;

        if($getTotalPayment > $request->user()->balance)
            return back()->withErrors(['status' => 'Saldo kamu tidak mencukupi untuk mengambil paket ini']);

        $subsAds = new Ads();

        $subsAds->fill($request->only(
            'package_id',
            'social_media',
            'url',
            'views',
        ));

        $subsAds->user_id = $request->user()->id;
        $subsAds->amount  = $package->benefits;
        $subsAds->title   = '';
        $subsAds->type    = Package::VIEWS;
        $subsAds->status  = ViewAds::ACTIVE;

        $subsAds->commission = $package->commission;

        $subsAds->saveOrFail();

        $this->storeTransaction($request, $package->price);

        return redirect(route('iklan.view.views'))->with(['status' => 'Berhasil memasang iklan untuk nama akun: ' . $request->account_name]);
    }

}
