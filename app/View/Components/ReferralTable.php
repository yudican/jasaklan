<?php

namespace App\View\Components;

use App\Models\Referral;
use App\Models\User;
use Illuminate\View\Component;

class ReferralTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $referrals;

    public function __construct($referrals)
    {
        $this->referrals = $referrals;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.referral-table');
    }
}
