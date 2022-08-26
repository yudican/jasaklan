<?php

namespace App\Http\Livewire\Table;

use App\Models\Balance;
use App\Models\HideableColumn;
use App\Models\ConfirmPayment;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class ConfirmPaymentTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $hideable = 'select';
    public $table_name = 'confirm_payments';

    public function builder()
    {
        return ConfirmPayment::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('user_id')->label('User Id')->searchable(),
            Column::name('nominal')->label('Nominal')->searchable(),
            Column::name('bank_asal')->label('Bank Asal')->searchable(),
            Column::name('bank_tujuan')->label('Bank Tujuan')->searchable(),
            Column::name('bank_nama_rekening')->label('Bank Nama Rekening')->searchable(),
            Column::callback(['bank_bukti_transfer', 'id'], function ($image, $bukti_transfer_id) {
                return '<button type="button" id="pay-button"
                class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                wire:click="download(' . $bukti_transfer_id . ')">Download Bukti</button>';
            })->label('Bank Bukti Transfer'),
            Column::callback('status', function ($status) {
                if ($status == 0) {
                    return '<span class="text-gray-500">Pending</span>';
                } elseif ($status == 1) {
                    return '<span class="text-green-500">Approved</span>';
                } elseif ($status == 2) {
                    return '<span class="text-red-500">Rejected</span>';
                }
            })->label('Status')->searchable(),

            Column::callback(['id'], function ($id) {
                return view('crud-generator-components::action-button', [
                    'id' => $id,
                    'actions' => [
                        [
                            'type' => 'button',
                            'route' => 'approve(' . $id . ')',
                            'label' => 'Terima',
                        ],
                        [
                            'type' => 'button',
                            'route' => 'decline(' . $id . ')',
                            'label' => 'Tolak',
                        ]
                    ]
                ]);
            })->label(__('Aksi')),
        ];
    }

    public function download($id)
    {
        $confirmPayment = ConfirmPayment::find($id);
        return $confirmPayment->download();
    }

    public function approve($id)
    {
        $confirmPayment = ConfirmPayment::find($id);
        $confirmPayment->status = 1;
        $confirmPayment->save();
        Balance::insert([
            [
                'amount' => $confirmPayment->nominal,
                'category' => 'credit',
                'description' => "Deposite",
                'status' => 1,
                'user_id' => $confirmPayment->user_id,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        $this->emit('refreshLivewireDatatable');
        $this->emit('showAlert', ['msg' => 'Pembayaran Berhasil di approve']);
    }
    public function decline($id)
    {
        $confirmPayment = ConfirmPayment::find($id);
        $confirmPayment->status = 2;
        $confirmPayment->save();
        $this->emit('refreshLivewireDatatable');
        $this->emit('showAlert', ['msg' => 'Pembayaran Ditolak']);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
