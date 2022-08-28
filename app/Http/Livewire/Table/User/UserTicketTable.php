<?php

namespace App\Http\Livewire\Table\User;

use App\Models\Ticket;
use Mediconesystems\LivewireDatatables\Column;
use Yudican\LaravelCrudGenerator\Livewire\Table\LivewireDatatable;

class UserTicketTable extends LivewireDatatable
{
  protected $listeners = ['refreshTable'];
  public $table_name = 'tickets';
  public $loading = false;

  public function builder()
  {
    return Ticket::query()->where('tickets.user_id', auth()->user()->id);
  }

  public function columns()
  {
    return [
      Column::name('id')->label('No.'),
      Column::name('name')->label('Nama Tiket')->searchable(),
      Column::callback('commission', function ($commission) {
        return 'Rp' . number_format($commission, 0, ',', '.');
      })->label('Komisi')->searchable(),
      Column::name('getAd.package.adsType.social_media')->label('Platform')->searchable(),
      Column::callback('notes', function ($notes) {
        if ($notes) {
          return $notes;
        }
        return '-';
      })->label('Catatan')->searchable(),
      Column::name('status')->label('Status')->searchable(),
    ];
  }
}
