<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class UserTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $hideable = 'select';
    public $table_name = 'users';
    public $hide = [];

    public function builder()
    {
        return User::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('No.'),
            Column::callback(['users.balance', 'users.id'], function ($balance, $user_id) {
                $user = User::find($user_id);
                return 'Rp ' . number_format($user->balance, 0, ',', '.');
            })->label('Balance')->searchable(),
            Column::name('username')->label('Username')->searchable()->hide(),
            Column::name('name')->label('Name')->searchable(),
            Column::name('email')->label('Email')->searchable(),
            Column::name('phone')->label('Phone')->searchable()->hide(),
            Column::name('address')->label('Address')->searchable()->hide(),
            Column::name('city')->label('City')->searchable()->hide(),
            Column::name('state')->label('State')->searchable()->hide(),
            Column::name('postal_code')->label('Postal Code')->searchable()->hide(),
            Column::callback(['users.active', 'users.id'], function ($status, $id) {
                if ($status == 0) {
                    return '<div class="toggle btn btn-round btn-black off" wire:click="toggleStatus(' . $id . ')" data-toggle="toggle" style="width: 92.8906px; height: 43.7812px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="info" data-style="btn-round"><div class="toggle-group"><label class="btn btn-info toggle-on">On</label><label class="btn btn-black active toggle-off">Off</label><span class="toggle-handle btn btn-black"></span></div></div>';
                }
                return '<div class="toggle btn btn-round btn-success"  wire:click="toggleStatus(' . $id . ')" data-toggle="toggle" style="width: 92.8906px; height: 43.7812px;"><input type="checkbox" checked="" data-toggle="toggle" data-onstyle="success" data-style="btn-round">
                    <div class="toggle-group"><label class="btn btn-success toggle-on">On</label><label class="btn btn-black active toggle-off">Off</label><span class="toggle-handle btn btn-black"></span></div>
                </div>';
            })->label(__(' Status')),

            Column::callback(['id'], function ($id) {
                return view('crud-generator-components::action-button', [
                    'id' => $id,
                    'actions' => [
                        [
                            'type' => 'button',
                            'route' => "getDataById('$id')",
                            'label' => 'Update',
                        ],
                        [
                            'type' => 'button',
                            'route' => "updateBalance('$id')",
                            'label' => 'Update Balance',
                        ],
                        [
                            'type' => 'button',
                            'route' => "updatePassword('$id')",
                            'label' => 'Update Password',
                        ]
                    ]
                ]);
            })->label(__('Aksi')),
        ];
    }

    public function updateBalance($id)
    {
        $this->emit('getUserId', $id);
        $this->emit('toggleBalanceModal', 'show');
    }
    public function updatePassword($id)
    {
        $this->emit('getUserId', $id);
        $this->emit('togglePasswordModal', 'show');
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        $user->update(['active' => $user->active > 0 ? 0 : 1]);
        $this->emit('refreshLivewireDatatable');
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function getDataById($id)
    {
        $this->emit('getDataUserById', $id);
    }

    public function getId($id)
    {
        $this->emit('getUserId', $id);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }
}
