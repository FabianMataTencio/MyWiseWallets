<?php

namespace App\Livewire;

use Livewire\Component;

class FinanceBox extends Component
{
    public $title;
    public $amount;
    
    public function __construct($title, $amount)
    {
        $this->title = $title;
        $this->amount = $amount;
    }

    public function render()
    {
        return view('livewire.finance-box');
    }
}
