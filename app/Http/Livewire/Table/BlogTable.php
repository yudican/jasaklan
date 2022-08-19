<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\Blog;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;

class BlogTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $table_name = 'blogs';

    public function builder()
    {
        return Blog::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::name('title')->label('Title')->searchable(),
            Column::name('created_at')->label('Tanggal Post')->searchable(),

            Column::callback(['id'], function ($id) {
                $toggleAction = $this->toggleAction;
                return view('livewire.components.action-button', [
                    'id' => $id,
                    'toggleAction' => $toggleAction,
                    'actions' => [
                        [
                            'type' => 'modal',
                            'route' => 'getDataById(' . $id . ')',
                            'label' => 'Edit',
                        ],
                        [
                            'type' => 'modal',
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
        $this->emit('getId', $id);
        $this->emit('confirmDelete', 'show');
    }


    public function getDataById($id)
    {
        $this->emit('getDataBlogById', $id);
    }

    public function getId($id)
    {
        $this->emit('getBlogId', $id);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
