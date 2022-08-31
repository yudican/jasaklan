<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\AdsType;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class AdsTypeTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $hideable = 'select';
    public $table_name = 'ads_types';

    public function builder()
    {
        return AdsType::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('type_name')->label('Type Name')->searchable(),
            Column::name('type_action')->label('Type Action')->searchable(),

            Column::callback(['id'], function ($id) {
                return view('livewire.components.action-button', [
                    'id' => $id,
                    'actions' => [
                        [
                            'type' => 'button',
                            'route' => 'getDataById(' . $id . ')',
                            'label' => 'Edit',
                        ],
                        [
                            'type' => 'button',
                            'route' => 'confirmDelete(' . $id . ')',
                            'label' => 'Hapus',
                        ]
                    ]
                ]);
            })->label(__('Aksi')),
        ];
    }

    public function getDataById($id)
    {
        $this->emit('getDataAdsTypeById', $id);
    }

    public function getId($id)
    {
        $this->emit('getAdsTypeId', $id);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
