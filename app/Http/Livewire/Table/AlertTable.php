<?php

namespace App\Http\Livewire\Table;

use App\Models\Alert;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class AlertTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $table_name = 'alerts';

    public function builder()
    {
        return Alert::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('title')->label('Title')->searchable(),
            Column::callback(['alerts.status', 'alerts.id'], function ($status, $id) {
                if ($status == 0) {
                    return '<div class="toggle btn btn-round btn-black off" wire:click="toggleStatus(' . $id . ')" data-toggle="toggle" style="width: 92.8906px; height: 43.7812px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="info" data-style="btn-round"><div class="toggle-group"><label class="btn btn-info toggle-on">On</label><label class="btn btn-black active toggle-off">Off</label><span class="toggle-handle btn btn-black"></span></div></div>';
                }
                return '<div class="toggle btn btn-round btn-success"  wire:click="toggleStatus(' . $id . ')" data-toggle="toggle" style="width: 92.8906px; height: 43.7812px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="success" data-style="btn-round">
                    <div class="toggle-group"><label class="btn btn-success toggle-on">On</label><label class="btn btn-black active toggle-off">Off</label><span class="toggle-handle btn btn-black"></span></div>
                </div>';
            })->label(__(' Status')),

            Column::callback(['id'], function ($id) {
                return view('livewire.components.action-button', [
                    'id' => $id,
                    'actions' => [
                        [
                            'type' => 'button',
                            'route' => "getDataById('$id')",
                            'label' => 'Update',
                        ],
                        [
                            'type' => 'button',
                            'route' => "confirmDelete('$id')",
                            'label' => 'Delete',
                        ],
                    ]
                ]);
            })->label(__('Aksi')),
        ];
    }

    public function confirmDelete($id)
    {
        $this->emit('getAlertId', $id);
        $this->emit('confirmDelete', 'show');
    }

    public function toggleStatus($id)
    {
        $alerts = Alert::all();
        foreach ($alerts as $key => $alert) {
            if ($alert->id == $id) {
                Alert::find($id)->update(['status' => $alert->status > 0 ? 0 : 1]);
            } else {
                Alert::find($alert->id)->update(['status' => 0]);
            }
        }
        $this->emit('refreshLivewireDatatable');
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function getDataById($id)
    {
        $this->emit('getDataAlertById', $id);
    }

    public function getId($id)
    {
        $this->emit('getAlertId', $id);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
