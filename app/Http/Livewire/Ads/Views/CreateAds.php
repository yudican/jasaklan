<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use App\Models\AdsType;
use App\Models\Package;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateAds extends Component
{
    public $ads_type_id;
    public $ads_url;
    public $ads_title;
    public $ads_package_id;
    public $social_media_id;
    public $number_of_views;
    public $packages = [];
    public $social_medias = [];
    public $package_lable;
    public $adsType;
    public $package_amount = 0;
    public $amount_to_pay = 0;
    public $package = null;
    public $type = 'views';

    public function mount($id)
    {
        $this->ads_type_id = $id;
        $this->adsType = AdsType::find($id);
        $this->social_medias = SocialMedia::where('ads_type_id', $this->ads_type_id)->get();
        $this->packages = Package::where('ads_type_id', $this->ads_type_id)->get();
    }
    public function render()
    {
        if ($this->ads_package_id) {
            $package = Package::find($this->ads_package_id);
            $this->package = $package;
            $this->amount_to_pay = $this->number_of_views * $package->price;
        }
        return view('livewire.ads.views.create-ads', [
            'ads_types' => AdsType::all(),
        ]);
    }

    public function saveAds()
    {
        $this->validate([
            'ads_type_id' => 'required',
            'ads_url' => 'required',
            'ads_title' => 'required',
            'ads_package_id' => 'required',
            'number_of_views' => 'numeric',
        ]);

        DB::beginTransaction();
        try {
            $social_media = SocialMedia::find($this->social_media_id);
            $user = auth()->user();
            if ($user->balance < $this->amount_to_pay) {
                return $this->emit('showAlertError', ['msg' => 'Saldo tidak mencukupi silahkan top up']);
            }
            $data = [
                'user_id' => $user->id,
                'social_media' => $social_media->social_media_name,
                'package_id' => $this->ads_package_id,
                'title' => $this->ads_title,
                'url' => $this->ads_url,
                'views' => $this->number_of_views,
                'amount' => $this->amount_to_pay,
                'type' => $this->type,
                'status' => 'active',
            ];
            Ads::create($data);

            DB::commit();
            return $this->emit('showAlert', ['msg' => 'Ads berhasil ditambahkan', 'redirect' => route('iklan.view.' . $this->type)]);
        } catch (\Throwable $th) {

            DB::rollback();
            return $this->emit('showAlertError', ['msg' => 'Ads gagal ditambahkan']);
            //throw $th;
        }
    }
}
