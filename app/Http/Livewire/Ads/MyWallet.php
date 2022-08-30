<?php

namespace App\Http\Livewire\Ads;

use Livewire\Component;

class MyWallet extends Component
{
    public $income = 0;
    public $expense = 0;
    public $balance = 0;
    public function mount()
    {
        $this->income = auth()->user()->balances()->where('category', 'credit')->where('status', 1)->sum('amount');
        $this->expense = auth()->user()->balances()->where('category', 'debit')->where('status', 1)->sum('amount');
        $this->balance = auth()->user()->balances()->where('status', 1)->sum('amount');
    }

    public function render()
    {
        return view('livewire.ads.my-wallet', [
            'transactions' => auth()->user()->balances()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
