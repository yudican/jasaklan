<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use App\Models\AdsType;
use App\Models\Balance;
use App\Models\Package;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAds extends Component
{
    use WithFileUploads;
    public $ads_type_id;
    public $ads_url;
    public $ads_title;
    public $ads_notes;
    public $ads_photo;
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
        $this->social_medias = SocialMedia::where('ads_type_id', $this->ads_type_id)->whereNotNull('updated_at')->get();
        $this->packages = Package::where('ads_type_id', $this->ads_type_id)->whereNotNull('updated_at')->get();
    }
    public function render()
    {
        if ($this->ads_package_id) {
            $package = Package::find($this->ads_package_id);
            $this->package = $package;
            if ($package->type == 'views') {
                $this->amount_to_pay = $this->number_of_views * $package->price;
            } else {
                $this->number_of_views = $package->benefits;
                $this->amount_to_pay = $package->price;
            }
        }
        return view('livewire.ads.views.create-ads', [
            'ads_types' => AdsType::whereNotNull('updated_at')->get(),
        ]);
    }

    public function saveAds()
    {
        $this->validate([
            'ads_type_id' => 'required',
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
                'notes' => $this->ads_notes,
                'url' => $this->ads_url ?? '#',
                'views' => $this->number_of_views,
                'amount' => $this->amount_to_pay,
                'type' => $this->type,
                'status' => 'active',
            ];

            if ($this->ads_photo) {
                $file = $this->ads_photo->store('images/ads', 'public');
                $data['photo'] = $file;
            }


            Balance::create([
                'user_id' => $user->id,
                'amount' => -$this->amount_to_pay,
                'description' => 'Pembayaran untuk iklan ' . $this->ads_title,
                'category' => 'debit',
                'status' => 1
            ]);
            Ads::create($data);

            DB::commit();
            return $this->emit('showAlert', ['msg' => 'Ads berhasil ditambahkan', 'redirect' => route('iklan.myads', ['type' => $this->package->type])]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            DB::rollback();
            return $this->emit('showAlertError', ['msg' => 'Ads gagal ditambahkan']);
            //throw $th;
        }
    }
}
