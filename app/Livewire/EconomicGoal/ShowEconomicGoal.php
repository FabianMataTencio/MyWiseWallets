<?php

namespace App\Livewire\EconomicGoal;

use Livewire\Component;

class ShowEconomicGoal extends Component
{
    public $economic_goal;

    public function render()
    {
        $percentage = $this->economic_goal->funds_deposited * 100 / $this->economic_goal->goal_amount;
        return view('livewire.economic-goal.show-economic-goal',[
            'percentage' => $percentage
        ]);
    }
}
