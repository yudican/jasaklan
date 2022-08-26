<?php

namespace App\Http\Livewire\Admin;

use App\Models\ConfirmPayment;
use Livewire\Component;


class ConfirmPaymentController extends Component
{
    
    public $confirm_payment_id;
    public $user_id;
public $nominal;
public $bank_asal;
public $bank_tujuan;
public $bank_nama_rekening;
public $bank_bukti_transfer;
public $status;
    
   

    public $route_name = null;

    public $form_active = false;
    public $form = false;
    public $update_mode = false;
    public $modal = true;

    protected $listeners = ['getDataConfirmPaymentById', 'getConfirmPaymentId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.confirm-payment')->layout(config('crud-generator.layout'));
    }

    public function store()
    {
        $this->_validate();
        
        $data = ['user_id'  => $this->user_id,
'nominal'  => $this->nominal,
'bank_asal'  => $this->bank_asal,
'bank_tujuan'  => $this->bank_tujuan,
'bank_nama_rekening'  => $this->bank_nama_rekening,
'bank_bukti_transfer'  => $this->bank_bukti_transfer,
'status'  => $this->status];

        ConfirmPayment::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = ['user_id'  => $this->user_id,
'nominal'  => $this->nominal,
'bank_asal'  => $this->bank_asal,
'bank_tujuan'  => $this->bank_tujuan,
'bank_nama_rekening'  => $this->bank_nama_rekening,
'bank_bukti_transfer'  => $this->bank_bukti_transfer,
'status'  => $this->status];
        $row = ConfirmPayment::find($this->confirm_payment_id);

        

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        ConfirmPayment::find($this->confirm_payment_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'user_id'  => 'required',
'nominal'  => 'required',
'bank_asal'  => 'required',
'bank_tujuan'  => 'required',
'bank_nama_rekening'  => 'required',
'bank_bukti_transfer'  => 'required',
'status'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataConfirmPaymentById($confirm_payment_id)
    {
        $this->_reset();
        $row = ConfirmPayment::find($confirm_payment_id);
        $this->confirm_payment_id = $row->id;
        $this->user_id = $row->user_id;
$this->nominal = $row->nominal;
$this->bank_asal = $row->bank_asal;
$this->bank_tujuan = $row->bank_tujuan;
$this->bank_nama_rekening = $row->bank_nama_rekening;
$this->bank_bukti_transfer = $row->bank_bukti_transfer;
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

    public function getConfirmPaymentId($confirm_payment_id)
    {
        $row = ConfirmPayment::find($confirm_payment_id);
        $this->confirm_payment_id = $row->id;
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
        $this->confirm_payment_id = null;
        $this->user_id = null;
$this->nominal = null;
$this->bank_asal = null;
$this->bank_tujuan = null;
$this->bank_nama_rekening = null;
$this->bank_bukti_transfer = null;
$this->status = null;
        $this->form = false;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = true;
    }
}
