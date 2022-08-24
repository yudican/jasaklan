<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use Livewire\Component;

class MyAdsList extends Component
{
    public $type = 'views';
    public function mount($type = 'views')
    {
        $this->type = $type;
    }
    public function render()
    {
        return view('livewire.ads.views.my-ads-list');
    }
}
