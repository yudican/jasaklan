<?php

namespace App\Http\Livewire\Admin;

use App\Models\AdsType;
use App\Models\SocialMedia;
use Livewire\Component;


class SocialMediaController extends Component
{

    public $social_media_id;
    public $ads_type_id;
    public $social_media_name;
    public $social_media_status;



    public $route_name = null;

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataSocialMediaById', 'getSocialMediaId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.social-media', [
            'ads_types' => AdsType::all()
        ])->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'ads_type_id'  => $this->ads_type_id,
            'social_media_name'  => $this->social_media_name,
            'social_media_status'  => $this->social_media_status
        ];

        SocialMedia::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'ads_type_id'  => $this->ads_type_id,
            'social_media_name'  => $this->social_media_name,
            'social_media_status'  => $this->social_media_status
        ];
        $row = SocialMedia::find($this->social_media_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        SocialMedia::find($this->social_media_id)->update(['updated_at' => null]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'ads_type_id'  => 'required',
            'social_media_name'  => 'required',
            'social_media_status'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataSocialMediaById($social_media_id)
    {
        $this->_reset();
        $row = SocialMedia::find($social_media_id);
        $this->social_media_id = $row->id;
        $this->ads_type_id = $row->ads_type_id;
        $this->social_media_name = $row->social_media_name;
        $this->social_media_status = $row->social_media_status;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getSocialMediaId($social_media_id)
    {
        $row = SocialMedia::find($social_media_id);
        $this->social_media_id = $row->id;
    }

    public function toggleForm($form)
    {
        $this->_reset();
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->_reset();
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->social_media_id = null;
        $this->ads_type_id = null;
        $this->social_media_name = null;
        $this->social_media_status = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
