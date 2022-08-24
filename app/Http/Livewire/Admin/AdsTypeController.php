<?php

namespace App\Http\Livewire\Admin;

use App\Models\AdsType;
use Livewire\Component;


class AdsTypeController extends Component
{

    public $ads_type_id;
    public $type_name;
    public $type_action;



    public $route_name = null;

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataAdsTypeById', 'getAdsTypeId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.ads-type')->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'type_name'  => $this->type_name,
            'type_action'  => $this->type_action
        ];

        AdsType::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'type_name'  => $this->type_name,
            'type_action'  => $this->type_action
        ];
        $row = AdsType::find($this->ads_type_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        AdsType::find($this->ads_type_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'type_name'  => 'required',
            'type_action'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataAdsTypeById($ads_type_id)
    {
        $this->_reset();
        $row = AdsType::find($ads_type_id);
        $this->ads_type_id = $row->id;
        $this->type_name = $row->type_name;
        $this->type_action = $row->type_action;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getAdsTypeId($ads_type_id)
    {
        $row = AdsType::find($ads_type_id);
        $this->ads_type_id = $row->id;
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
        $this->ads_type_id = null;
        $this->type_name = null;
        $this->type_action = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
