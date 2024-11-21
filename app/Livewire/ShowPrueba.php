<?php

namespace App\Livewire;

use App\Models\Income;
use Livewire\Component;

class ShowPrueba extends Component
{
    public function render()
    {
        $incomes = Income::where('user_id', auth()->user()->id)->paginate(15);
        return view('livewire.show-prueba', [
            'incomes' => $incomes
        ]);
    }
}
