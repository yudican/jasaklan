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
    ];
  }
}
