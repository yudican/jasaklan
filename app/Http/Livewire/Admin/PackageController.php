<?php

namespace App\Http\Livewire\Admin;

use App\Models\AdsType;
use App\Models\Package;
use Livewire\Component;


class PackageController extends Component
{
    public $package_id;
    public $name;
    public $label;
    public $type;
    public $price;
    public $benefits;
    public $commission;
    public $ads_type_id;

    public $route_name = null;

    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    protected $listeners = ['getDataPackageById', 'getPackageId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        $packages = Package::all();
        foreach ($packages as $key => $package) {
            $price  = number_format($package->price);
            $benefits  = number_format($package->benefits);
            $package->update([
                'name' => "Rp $price / $benefits $package->label"
            ]);
        }
        return view('livewire.admin.package', [
            'ads_types' => AdsType::all()
        ])->layout('layouts.admin');
    }

    public function store()
    {
        $this->_validate();

        $data = [
            'name'  => $this->name,
            'label'  => $this->label,
            'type'  => $this->type,
            'price'  => $this->price,
            'benefits'  => $this->benefits,
            'commission'  => $this->commission,
            'ads_type_id'  => $this->ads_type_id
        ];

        Package::create($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = [
            'name'  => $this->name,
            'label'  => $this->label,
            'type'  => $this->type,
            'price'  => $this->price,
            'benefits'  => $this->benefits,
            'commission'  => $this->commission,
            'ads_type_id'  => $this->ads_type_id
        ];
        $row = Package::find($this->package_id);



        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Package::find($this->package_id)->update(['updated_at' => null]);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'name'  => 'required',
            'label'  => 'required',
            'type'  => 'required',
            'price'  => 'required',
            'benefits'  => 'required',
            'commission'  => 'required',
            'ads_type_id'  => 'required',

        ];

        return $this->validate($rule);
    }

    public function getDataPackageById($package_id)
    {
        $this->_reset();
        $row = Package::find($package_id);
        $this->package_id = $row->id;
        $this->name = $row->name;
        $this->label = $row->label;
        $this->type = $row->type;
        $this->price = $row->price;
        $this->benefits = $row->benefits;
        $this->commission = $row->commission;
        $this->ads_type_id = $row->ads_type_id;
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getPackageId($package_id)
    {
        $row = Package::find($package_id);
        $this->package_id = $row->id;
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
        $this->emit('refreshTable');
        $this->package_id = null;
        $this->name = null;
        $this->label = null;
        $this->type = null;
        $this->price = null;
        $this->benefits = null;
        $this->commission = null;
        $this->ads_type_id = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
    }
}
