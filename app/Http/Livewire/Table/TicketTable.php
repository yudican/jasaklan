<?php

namespace App\Http\Livewire\Table;

use App\Models\Balance;
use App\Models\Ticket;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

// use App\Http\Livewire\Table\LivewireDatatable;

class TicketTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    // public $hideable = 'select';
    public $table_name = 'tickets';
    public $hide = [];
    public $loading = false;

    public function builder()
    {
        if (request()->segment(1) == 'advertiser') {
            return Ticket::query()->whereHas('getAd', function ($q) {
                $q->where('ads.user_id', auth()->user()->id);
            });
        }
        return Ticket::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('name')->label('Nama Tiket')->searchable(),
            // Column::name('account_name')->label('Account Name')->searchable(),
            Column::name('getAd.title')->label('Judul Iklan')->searchable()->hide(),
            Column::callback('getAd.package.commission', function ($commission) {
                return 'Rp' . number_format($commission, 0, ',', '.');
            })->label('Komisi')->searchable(),
            Column::callback(['screenshot', 'id'], function ($image, $ticket_id) {
                if ($image) {
                    $file = "'$image'";
                    return '<a href="#" wire:click="downloadImge(' . $file . ')">Download Image</a>';
                }
                return '-';
            })->label('Screenshot'),
            Column::callback(['screenshot_akhir', 'id'], function ($image, $ticket_id) {
                if ($image) {
                    $file = "'$image'";
                    return '<a href="#" wire:click="downloadImge(' . $file . ')">Download Image</a>';
                }
                return '-';
            })->label('Screenshot Akhir'),
            Column::name('status')->label('Status')->searchable(),
            Column::name('user.name')->label('User')->hide(),

            Column::callback(['id'], function ($id) {
                $ticket = Ticket::find($id);
                if ($ticket->status == 'review') {
                    if (request()->segment(1) == 'advertiser') {
                        $approve  = "'approve'";
                        $reject  = "'reject'";
                        return '<div>
                        <button wire:click="updateStatus(' . $id . ',' . $reject . ')" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Reject</button>
                        <button wire:click="updateStatus(' . $id . ',' . $approve . ')" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Approve</button>
                        </div>';
                    }
                    return view('crud-generator-components::action-button', [
                        'id' => $id,
                        'actions' => [
                            [
                                'type' => 'button',
                                'route' => 'updateStatus(' . $id . ',"reject")',
                                'label' => 'Reject',
                            ],
                            [
                                'type' => 'button',
                                'route' => 'updateStatus(' . $id . ',"approve")',
                                'label' => 'Approve',
                            ]
                        ]
                    ]);
                }
                return null;
            })->label(__('Aksi')),
        ];
    }

    public function downloadImge($type = null)
    {
        return response()->download(storage_path('/app/public/images/tickets/proofs/' . $type));
    }

    public function updateStatus($id, $status)
    {
        $ticket = Ticket::find($id);
        if ($status == 'approve') {
            $ads_title = $ticket->getAd->title;
            Balance::insert([
                [
                    'amount' => $ticket->getAd->package->commission,
                    'category' => 'credit',
                    'description' => "Menonton Iklan $ads_title $ticket->ads_id",
                    'user_id' => $ticket->user_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
            $ticket->update(['status' => $status]);
            $this->refreshTable();
            return $this->emit('showAlert', ['msg' => 'Tiket Berhasil di ' . $status]);
        } else {
            return $this->emit('setTicketId', $id);
            // $number_of_views = $ticket->getAd->views + 1;
            // $dataView = [
            //     'views' => $number_of_views,
            //     'status' => $number_of_views == 0 ? 'finish' : 'active',
            // ];
            // $ticket->getAd()->update($dataView);
        }
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
