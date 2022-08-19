<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonGreen extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $addclass;
    public $name;

     public function __construct($name, $addclass)
    {
        $this->addclass = $addclass;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-green');
    }
}
