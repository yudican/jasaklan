<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\SocialMedia;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class SocialMediaTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $hideable = 'select';
    public $table_name = 'social_media';

    public function builder()
    {
        return SocialMedia::query()->whereNotNull('updated_at');
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('adsType.type_name')->label('Ads Type Id')->searchable(),
            Column::name('social_media_name')->label('Social Media Name')->searchable(),
            Column::name('social_media_status')->label('Social Media Status')->searchable(),

            Column::callback(['id'], function ($id) {
                return view('crud-generator-components::action-button', [
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

    public function confirmDelete($id)
    {
        $this->getId($id);
        $this->emit('confirmDelete', 'show');
    }

    public function getDataById($id)
    {
        $this->emit('getDataSocialMediaById', $id);
    }

    public function getId($id)
    {
        $this->emit('getSocialMediaId', $id);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
