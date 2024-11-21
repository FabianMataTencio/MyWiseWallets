<?php

namespace App\Livewire;

use Livewire\Component;

class ShowIncome extends Component
{
    public $income;
    
    public function render()
    {
        return view('livewire.show-income');
    }
}
