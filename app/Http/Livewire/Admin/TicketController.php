<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ticket;
use Livewire\Component;


class TicketController extends Component
{

    public $ticket_id;
    public $account_name;
    public $ads_id;
    public $commission;
    public $name;
    public $screenshot;
    public $screenshot_akhir;
    public $status;
    public $notes;
    public $user_id;



    public $route_name = null;

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataTicketById', 'getTicketId', 'setTicketId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.ticket')->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'account_name'  => $this->account_name,
            'ads_id'  => $this->ads_id,
            'commission'  => $this->commission,
            'name'  => $this->name,
            'screenshot'  => $this->screenshot,
            'screenshot_akhir'  => $this->screenshot_akhir,
            'status'  => $this->status,
            'user_id'  => $this->user_id
        ];

        Ticket::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'account_name'  => $this->account_name,
            'ads_id'  => $this->ads_id,
            'commission'  => $this->commission,
            'name'  => $this->name,
            'screenshot'  => $this->screenshot,
            'screenshot_akhir'  => $this->screenshot_akhir,
            'status'  => $this->status,
            'user_id'  => $this->user_id
        ];
        $row = Ticket::find($this->ticket_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Ticket::find($this->ticket_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'account_name'  => 'required',
            'ads_id'  => 'required',
            'commission'  => 'required',
            'name'  => 'required',
            'screenshot'  => 'required',
            'screenshot_akhir'  => 'required',
            'status'  => 'required',
            'user_id'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataTicketById($ticket_id)
    {
        $this->_reset();
        $row = Ticket::find($ticket_id);
        $this->ticket_id = $row->id;
        $this->account_name = $row->account_name;
        $this->ads_id = $row->ads_id;
        $this->commission = $row->commission;
        $this->name = $row->name;
        $this->screenshot = $row->screenshot;
        $this->screenshot_akhir = $row->screenshot_akhir;
        $this->status = $row->status;
        $this->user_id = $row->user_id;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getTicketId($ticket_id)
    {
        $row = Ticket::find($ticket_id);
        $this->ticket_id = $row->id;
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
        $this->emit('toggleModalReject', 'hide');
        $this->ticket_id = null;
        $this->notes = null;
        $this->account_name = null;
        $this->ads_id = null;
        $this->commission = null;
        $this->name = null;
        $this->screenshot = null;
        $this->screenshot_akhir = null;
        $this->status = null;
        $this->user_id = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }

    public function setTicketId($id)
    {
        $this->emit('toggleModalReject', 'show');
        $this->ticket_id = $id;
    }

    public function saveReject()
    {
        $ticket = Ticket::find($this->ticket_id);
        $number_of_views = $ticket->getAd->views + 1;
        $dataView = [
            'views' => $number_of_views,
            'status' => $number_of_views == 0 ? 'finish' : 'active',
        ];
        $ticket->getAd()->update($dataView);
        $ticket->update([
            'status' => 'reject',
            'notes' => $this->notes,
        ]);
        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Tiket Berhasil Ditolak']);
    }
}
