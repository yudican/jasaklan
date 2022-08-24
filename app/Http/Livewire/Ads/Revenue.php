<?php

namespace App\Http\Livewire\Ads;

use Livewire\Component;

class Revenue extends Component
{
    public $revenue_today = 0;
    public $revenue_total = 0;
    public function mount()
    {
        $user = auth()->user();
        $revenue_today = $user->balances()->where('status', 0)->where('description', 'like', "%Menonton Iklan%")->where('created_at', now())->sum('amount');
        $revenue_total = $user->balances()->where('description', 'like', "%Menonton Iklan%")->sum('amount');

        $this->revenue_today = 'Rp ' . number_format($revenue_today);
        $this->revenue_total = 'Rp ' . number_format($revenue_total);
    }
    public function render()
    {
        return view('livewire.ads.revenue');
    }

    public function transferToWallet()
    {
        $user = auth()->user();
        $user->balances()->where('status', 0)->update(['status' => 1]);

        return $this->emit('showAlert', ['msg' => 'Berhasil Transfer Ke Wallet']);
    }
}
