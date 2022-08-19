<?php

namespace App\Http\Livewire\Table;

use App\Models\Ticket;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;

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
                $toggleAction = $this->toggleAction;
                $ticket = Ticket::find($id);
                if ($ticket->status == 'review') {
                    return view('livewire.components.action-button', [
                        'id' => $id,
                        'toggleAction' => $toggleAction,
                        'actions' => [
                            [
                                'type' => 'modal',
                                'route' => 'updateStatus(' . $id . ',"reject")',
                                'label' => 'Reject',
                            ],
                            [
                                'type' => 'modal',
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
        Ticket::find($id)->update(['status' => $status]);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
