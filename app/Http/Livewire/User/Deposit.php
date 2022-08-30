<?php

namespace App\Http\Livewire\User;

use App\Models\Balance;
use App\Models\ConfirmPayment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Deposit extends Component
{
    use WithFileUploads;
    public $deposit_amount;
    public $pembayaran;
    public $pembayaran_type;
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
        $rules = [
            'deposit_amount' => 'required|numeric',
            'pembayaran_type' => 'required',
        ];
        if ($this->pembayaran_type == 'manual') {
            $rules['pembayaran'] = 'required';
        }

        $this->validate($rules);

        if ($this->deposit_amount < getSetting('MINIMUM_DEPOSIT')) {
            return  $this->emit('showAlertError', ['msg' => 'Minimum deposit adalah ' . getSetting('MINIMUM_DEPOSIT')]);
        }

        if ($this->pembayaran_type == 'otomatis') {
            $client = new Client();
            $user = auth()->user();
            $merchantCode = 'DS13112'; // from duitku
            $merchantKey = 'c219145cd23ef0062d42566bc9715060'; // from duitku
            $timestamp = round(microtime(true) * 1000);
            $data = [
                "paymentAmount" =>  (int) $this->deposit_amount,
                "merchantOrderId" =>  '#' . time(),
                "productDetails" =>  "Deposit",
                "additionalParam" =>  "",
                "merchantUserInfo" =>  "",
                "customerVaName" =>  $user->name,
                "email" =>  $user->email,
                "phoneNumber" =>  '',
                "itemDetails" =>  [[
                    "name" =>  "Deposit",
                    "price" =>  (int) $this->deposit_amount,
                    "quantity" =>  1
                ]],

                "callbackUrl" =>  "https://jasaklan.com/callback",
                "returnUrl" =>  "https://jasaklan.com/user/wallet",
                "expiryPeriod" =>  1
            ];

            $signature = hash('sha256', $merchantCode . $timestamp . $merchantKey);
            try {
                $response = $client->request('POST', 'https://api-sandbox.duitku.com/api/merchant/createInvoice', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'x-duitku-signature' =>  $signature,
                        'x-duitku-timestamp' =>   $timestamp,
                        'x-duitku-merchantcode' =>   $merchantCode
                    ],
                    'body' => json_encode($data)
                ]);

                $responseJSON = json_decode($response->getBody(), true);
                if ($responseJSON['statusMessage'] == 'SUCCESS') {
                    Balance::create([
                        'amount' => $this->deposit_amount,
                        'category' => 'credit',
                        'description' => "Deposit#" . $responseJSON['reference'],
                        'status' => 2,
                        'user_id' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    return $this->emit('showAlert', ['msg' => 'Pembayaran Berhasil Dibuat', 'redirect' => $responseJSON['paymentUrl']]);
                }
                return $this->emit('showAlertError', ['msg' => 'Pembayaran Gagal Dibuat']);
            } catch (ClientException $th) {
                $response = $th->getResponse();
                $responseBody = json_decode($response->getBody(), true);
                dd($responseBody);
            }
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
