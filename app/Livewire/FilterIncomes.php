<?php

namespace App\Livewire;

use App\Models\Categorie;
use Livewire\Component;

class FilterIncomes extends Component
{
    public $categorie_id;
    public $start_date;
    public $end_date;
    public $minimum_amount;
    public $maximun_amount;
    

    public function readFilterData(){
        $this->dispatch('dataTerms', $this->categorie_id, $this->start_date, $this->end_date, $this->minimum_amount, $this->maximun_amount);
    }

    
    public function resetFilters()
    {
        $this->reset(['categorie_id', 'start_date', 'end_date', 'minimum_amount', 'maximun_amount']);
        $this->dispatch('dataTerms', null, null, null, null, null); // Emitir filtros vacíos
    }
    
    public function render()
    {
        $categories = Categorie::where('user_id', auth()->id())
                                ->get();
        return view('livewire.filter-incomes',[
            'categories' => $categories,

        ]);
    }
}
