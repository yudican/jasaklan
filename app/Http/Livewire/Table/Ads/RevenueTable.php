<?php

namespace App\Http\Livewire\Table\Ads;

use App\Models\Balance;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class RevenueTable extends LivewireDatatable
{
  protected $listeners = ['refreshTable'];
  public $table_name = 'tickets';
  public $loading = false;

  public function builder()
  {
    return Balance::query()->where('description', 'like', "%Menonton Iklan%")->where('user_id', auth()->user()->id);
  }

  public function columns()
  {
    return [
      Column::name('id')->label('Id Penghasilan'),
      Column::callback('amount', function ($amount) {
        return 'Rp' . number_format($amount, 0, ',', '.');
      })->label('JUMLAH'),
      Column::callback('status', function ($status) {
        if ($status == 1) {
          return 'Sudah Di Transfer';
        }
        return 'Belum';
      })->label('SUDAH DITRANSFER'),
      Column::callback('description', function ($description) {
        // remove number from description
        $description = preg_replace('/\d+/', '', $description);
        return $description;
      })->label('Keterangan'),
      Column::name('created_at')->label('Waktu'),
    ];
  }
}
