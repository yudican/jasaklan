<?php

namespace App\Http\Livewire\Admin;

use App\Models\GeneralSetting;
use Livewire\Component;


class GeneralSettingController extends Component
{

    public $general_setting_id;
    public $name;
    public $value;



    public $route_name = null;

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataGeneralSettingById', 'getGeneralSettingId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.general-setting')->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'name'  => $this->name,
            'value'  => $this->value
        ];

        GeneralSetting::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'name'  => $this->name,
            'value'  => $this->value
        ];
        $row = GeneralSetting::find($this->general_setting_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        GeneralSetting::find($this->general_setting_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'name'  => 'required',
            'value'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataGeneralSettingById($general_setting_id)
    {
        $this->_reset();
        $row = GeneralSetting::find($general_setting_id);
        $this->general_setting_id = $row->id;
        $this->name = $row->name;
        $this->value = $row->value;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getGeneralSettingId($general_setting_id)
    {
        $row = GeneralSetting::find($general_setting_id);
        $this->general_setting_id = $row->id;
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
        $this->general_setting_id = null;
        $this->name = null;
        $this->value = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
