<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use Livewire\Component;

class MyAdsList extends Component
{
    public $type = 'views';
    public $ads_type_id;
    public $ads_url;
    public $ads_title;
    public $package;

    protected $listeners = [
        'getDataById', 'getId'
    ];
    public function mount($type = 'views')
    {
        $this->type = $type;
    }
    public function render()
    {
        return view('livewire.ads.views.my-ads-list');
    }

    public function getDataById($id)
    {
        $row = Ads::find($id);
        $this->ads_type_id = $row->id;
        $this->ads_url = $row->url;
        $this->ads_title = $row->title;
        $this->package = $row->package;

        return $this->emit('showModalUpdate', 'show');
    }

    public function saveAds()
    {
        $this->validate([
            'ads_type_id' => 'required',
            'ads_url' => 'required',
            'ads_title' => 'required',
        ]);
        $ads = Ads::find($this->ads_type_id);
        $ads->url = $this->ads_url;
        $ads->title = $this->ads_title;
        $ads->save();
        $this->emit('showModalUpdate', 'hide');
        return $this->emit('showAlert', ['msg' => 'Iklan Berhasil Diperbarui']);
    }

    public function _reset()
    {
        $this->emit('showModalUpdate', 'hide');
        $this->emit('refreshTable');
        $this->ads_type_id = null;
        $this->ads_url = null;
        $this->ads_title = null;
    }
}
