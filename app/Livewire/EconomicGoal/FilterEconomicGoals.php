<?php

namespace App\Livewire\EconomicGoal;

use Livewire\Component;

class FilterEconomicGoals extends Component
{
    public $goal_name;
    public $start_date;
    public $end_date;
    public $minimum_goal_amount; 
    public $maximun_goal_amount;
    public $maximun_funds_amount;
    public $minimum_funds_amount;

    public function readFilterData(){
        $this->dispatch('dataTerms', 
            $this->goal_name, 
            $this->start_date, 
            $this->end_date, 
            $this->minimum_goal_amount, 
            $this->maximun_goal_amount,
            $this->maximun_funds_amount,
            $this->minimum_funds_amount
         );
    }

    
    public function resetFilters()
    {
        $this->reset(['goal_name', 
            'start_date', 
            'end_date', 
            'minimum_goal_amount', 
            'maximun_goal_amount',
            'maximun_funds_amount',
            'minimum_funds_amount'
        ]);
        $this->dispatch('dataTerms', null, null, null, null, null, null, null); 
    }

    public function render()
    {
        return view('livewire.economic-goal.filter-economic-goals');
    }
}
