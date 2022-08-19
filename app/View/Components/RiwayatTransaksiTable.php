<?php

namespace App\View\Components;

use App\Models\Transaction;
use Illuminate\View\Component;

class RiwayatTransaksiTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $transactions;
    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.riwayat-transaksi-table');
    }
}
