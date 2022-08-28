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
    public $hideable = 'select';
    public $table_name = 'tickets';
    public $hide = [];

    public function builder()
    {
        return Ticket::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('name')->label('Nama Tiket')->searchable(),
            Column::name('account_name')->label('Account Name')->searchable(),
            Column::name('getAd.title')->label('Ads')->searchable()->hide(),
            Column::callback('commission', function ($commission) {
                return 'Rp' . number_format($commission, 0, ',', '.');
            })->label('Komisi')->searchable(),
            Column::callback(['screenshot', 'id'], function ($image, $ticket_id) {
                return '<a href="' . route('admin.ticket.download', $ticket_id) . '">Download Image</a>';
            })->label('Screenshot'),
            Column::name('status')->label('Status')->searchable(),
            Column::name('user.name')->label('User')->hide(),

            Column::callback(['id'], function ($id) {
                $ticket = Ticket::find($id);
                if ($ticket->status == 'review') {
                    return view('livewire.components.action-button', [
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
        } else {
            $number_of_views = $ticket->getAd->views + 1;
            $dataView = [
                'views' => $number_of_views,
                'status' => $number_of_views == 0 ? 'finish' : 'active',
            ];
            $ticket->getAd()->update($dataView);
        }

        $ticket->update(['status' => $status]);
        $this->refreshTable();
        return $this->emit('showAlert', ['msg' => 'Tiket Berhasil di ' . $status]);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
