<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;


class UserController extends Component
{

    public $user_id;
    public $username;
    public $balance = 0;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $city;
    public $state;
    public $postal_code;
    public $active;



    public $route_name = null;

    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataUserById', 'getUserId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.admin.user')->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'username'  => $this->username,
            'name'  => $this->name,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'address'  => $this->address,
            'city'  => $this->city,
            'state'  => $this->state,
            'postal_code'  => $this->postal_code,
            'active'  => $this->active
        ];

        User::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function saveBalance()
    {
        $this->validate([
            'balance' => 'required|numeric'
        ]);

        $user = User::find($this->user_id);
        $user->balance = $this->balance;
        $user->save();
        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Balance Berhasil Diupdate']);
    }

    public function savePassword()
    {
        $this->validate([
            'password' => 'required|min:6'
        ]);

        $user = User::find($this->user_id);
        $user->password = Hash::make($this->password);
        $user->save();
        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Password Berhasil Diupdate']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'username'  => $this->username,
            'name'  => $this->name,
            'email'  => $this->email,
            'phone'  => $this->phone,
            'address'  => $this->address,
            'city'  => $this->city,
            'state'  => $this->state,
            'postal_code'  => $this->postal_code,
            'active'  => $this->active
        ];
        $row = User::find($this->user_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        User::find($this->user_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'username'  => 'required',
            'name'  => 'required',
            'email'  => 'required',
            'phone'  => 'required',
            'active'  => 'required'
        ];

        return $this->validate($rule);
    }

    public function getDataUserById($user_id)
    {
        $this->_reset();
        $row = User::find($user_id);
        $this->user_id = $row->id;
        $this->username = $row->username;
        $this->name = $row->name;
        $this->email = $row->email;
        $this->phone = $row->phone;
        $this->address = $row->address;
        $this->city = $row->city;
        $this->state = $row->state;
        $this->postal_code = $row->postal_code;
        $this->active = $row->active;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getUserId($user_id)
    {
        $row = User::find($user_id);
        $this->user_id = $row->id;
        $this->balance = $row->balance;
    }

    public function toggleForm($form)
    {
        $this->_reset();
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->_reset();
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('toggleBalanceModal', 'hide');
        $this->emit('togglePasswordModal', 'hide');
        $this->emit('refreshTable');
        $this->user_id = null;
        $this->username = null;
        $this->balance = 0;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->phone = null;
        $this->address = null;
        $this->city = null;
        $this->state = null;
        $this->postal_code = null;
        $this->active = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
