<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RiwayatPenghasilanTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $revenues;
    public function __construct($revenues)
    {
        $this->revenues = $revenues;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.riwayat-penghasilan-table');
    }
}
