<?php

namespace App\Http\Livewire\User;

use App\Models\ConfirmPayment;
use Livewire\Component;
use Livewire\WithFileUploads;

class Deposit extends Component
{
    use WithFileUploads;
    public $deposit_amount;
    public $pembayaran;
    public $bank_asal;
    public $bank_tujuan;
    public $bank_nama_rekening;
    public $bank_bukti_transfer;
    public $showConfirm = false;
    public function render()
    {
        return view('livewire.user.deposit');
    }

    public function deposit()
    {
        $this->validate([
            'deposit_amount' => 'required|numeric',
            'pembayaran' => 'required',
        ]);
        if ($this->deposit_amount < getSetting('MINIMUM_DEPOSIT')) {
            return  $this->emit('showAlertError', ['msg' => 'Minimum deposit adalah ' . getSetting('MINIMUM_DEPOSIT')]);
        }
        $this->showConfirm = true;
    }

    public function uploadBukti()
    {
        $this->validate([
            'bank_asal' => 'required',
            'bank_tujuan' => 'required',
            'bank_nama_rekening' => 'required',
            'bank_bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $data = [
            'nominal' => $this->deposit_amount,
            'bank_asal' => $this->bank_asal,
            'bank_tujuan' => $this->bank_tujuan,
            'bank_nama_rekening' => $this->bank_nama_rekening,
            'user_id' => auth()->user()->id,
            'status' => 0
        ];

        if ($this->bank_bukti_transfer) {
            $file = $this->bank_bukti_transfer->store('images/tickets/bukti_transfer', 'public');
            $data['bank_bukti_transfer'] = $file;
        }

        ConfirmPayment::create($data);

        return $this->emit('showAlert', ['msg' => 'Bukti Pembayaran Berhasil Diupload', 'redirect' => route('user.wallet')]);
    }
}
