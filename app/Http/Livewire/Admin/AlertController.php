<?php

namespace App\Http\Livewire\Admin;

use App\Models\Alert;
use Livewire\Component;


class AlertController extends Component
{

    public $alert_id;
    public $title;
    public $body;
    public $status = 0;

    public $route_name = null;

    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataAlertById', 'getAlertId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.alert')->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'title'  => $this->title,
            'body'  => $this->body,
            'status'  => $this->status
        ];

        Alert::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'title'  => $this->title,
            'body'  => $this->body,
            'status'  => $this->status
        ];
        $row = Alert::find($this->alert_id);

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Alert::find($this->alert_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }



    public function _validate()
    {
        $rule = [
            'title'  => 'required',
            'body'  => 'required',
        ];

        return $this->validate($rule);
    }

    public function getDataAlertById($alert_id)
    {
        $this->_reset();
        $row = Alert::find($alert_id);
        $this->alert_id = $row->id;
        $this->title = $row->title;
        $this->body = $row->body;
        $this->status = $row->status;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getAlertId($alert_id)
    {
        $row = Alert::find($alert_id);
        $this->alert_id = $row->id;
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
        $this->alert_id = null;
        $this->title = null;
        $this->body = null;
        $this->status = 0;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
