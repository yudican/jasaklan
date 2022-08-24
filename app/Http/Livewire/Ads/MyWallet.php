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
        $balance = auth()->user()->balances();
        $this->income = $balance->where('category', 'credit')->sum('amount');
        $this->expense = $balance->where('category', 'debit')->sum('amount');
        $this->balance = $balance->sum('amount');
    }

    public function render()
    {
        return view('livewire.ads.my-wallet', [
            'transactions' => auth()->user()->balances()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
