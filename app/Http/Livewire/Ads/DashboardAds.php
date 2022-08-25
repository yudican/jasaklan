<?php

namespace App\Http\Livewire\Ads;

use App\Models\AdsType;
use Livewire\Component;

class DashboardAds extends Component
{
    public function render()
    {
        $adsTypes =  AdsType::all();
        return view('livewire.ads.dashboard-ads', compact('adsTypes'));
    }
}
