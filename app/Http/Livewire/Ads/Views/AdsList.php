<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use Livewire\Component;

class AdsList extends Component
{
    public $type = 'views';
    public function mount($type = 'views')
    {
        $this->type = $type;
    }
    public function render()
    {
        return view('livewire.ads.views.ads-list', [
            'views' => Ads::whereHas('package', function ($query) {
                $query->where('type', $this->type);
            })->whereHas('package.adsType', function ($query) {
                $query->where('type_action', 'view')->where('user_id', '!=', auth()->user()->id);
            })->whereDoesntHave('userViews', function ($query) {
                $query->where('users.id', auth()->user()->id);
            })->paginate(10)->withQueryString(),
            'view_tickets' => Ads::whereHas('package', function ($query) {
                $query->where('type', $this->type);
            })->whereHas('package.adsType', function ($query) {
                $query->where('type_action', 'ticket')->where('user_id', '!=', auth()->user()->id);
            })->whereDoesntHave('tickets', function ($query) {
                $query->where('tickets.user_id', auth()->user()->id);
            })->paginate(10)->withQueryString(),
        ]);
    }
}
