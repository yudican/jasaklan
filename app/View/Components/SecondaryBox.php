<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SecondaryBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $value;
    public $class;

    public function __construct($title, $value, $class = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.secondary-box');
    }
}
