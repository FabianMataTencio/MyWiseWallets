<?php

namespace App\Livewire\Outcome;

use Livewire\Component;

class ShowOutcome extends Component
{
    public $outcome;

    public function render()
    {
        return view('livewire.outcome.show-outcome');
    }
}
