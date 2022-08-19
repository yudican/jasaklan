<?php

namespace App\Http\Livewire;

use App\Models\Ads;
use App\Models\Blog;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'total_member' => User::count(),
            'total_post' => Blog::count(),
            'total_transaction' => Transaction::count(),
            'total_ads' => Ads::count(),
        ])->layout('layouts.admin');
    }
}
