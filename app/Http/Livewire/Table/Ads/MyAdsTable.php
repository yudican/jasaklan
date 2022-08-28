<?php

namespace App\Http\Livewire\Table\Ads;

use App\Models\Ads as AdsModel;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class MyAdsTable extends LivewireDatatable
{
  protected $listeners = ['refreshTable'];
  public $table_name = 'tickets';
  public $loading = false;

  public function builder()
  {
    return AdsModel::query()->whereHas('package', function ($query) {
      $query->where('type', $this->params);
    })->where('ads.user_id', auth()->user()->id);
  }

  public function columns()
  {
    return [
      Column::name('id')->label('No.'),
      Column::name('title')->label('Nama Iklan')->searchable(),
      Column::name('package.name')->label('Paket Iklan')->searchable(),
      Column::name('url')->label('Url Iklan')->searchable(),
      Column::name('social_media')->label('Platform')->searchable(),
      Column::callback(['package.commission', 'package.type'], function ($commission, $type) {
        return 'Rp' . number_format($commission, 0, ',', '.') . ' / ' . $type;
      })->label('Pengeluaran')->searchable(),
      Column::name('status')->label('Status')->searchable(),
      Column::callback('id', function ($id) {
        return '<button wire:click="getDataById(' . $id . ')" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">edit</button>';
      })->label('Aksi'),
    ];
  }

  public function getDataById($id)
  {
    $this->emit('getDataById', $id);
  }

  public function getId($id)
  {
    $this->emit('getId', $id);
  }

  public function refreshTable()
  {
    $this->emit('refreshLivewireDatatable');
  }
}
