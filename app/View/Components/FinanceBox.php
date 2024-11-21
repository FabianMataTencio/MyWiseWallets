<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FinanceBox extends Component
{
    public $title;
    public $amount;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $amount)
    {
        $this->title = $title;
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.finance-box');
    }
}
