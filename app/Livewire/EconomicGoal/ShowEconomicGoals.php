<?php

namespace App\Livewire\EconomicGoal;

use App\Models\Categorie;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\EconomicGoal;

class ShowEconomicGoals extends Component
{
    public $goal_name;
    public $start_date;
    public $end_date;
    public $minimum_goal_amount; 
    public $maximun_goal_amount;
    public $maximun_funds_amount;
    public $minimum_funds_amount;

    protected $listeners = ['dataTerms' => 'search'];

    protected $liseners = ['deleteEconomicGoal'];

    #[On('deleteEconomicGoal')]

    public function deleteEconomicGoal(Categorie $categorie){
        $categorie->delete();
        $this->dispatch('economicGoalDeleted');
    }  

public function search($goal_name, $start_date, $end_date, $minimum_goal_amount, $maximun_goal_amount, $maximun_funds_amount, $minimum_funds_amount ){
        $this->goal_name = $goal_name;       
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->minimum_goal_amount = $minimum_goal_amount;
        $this->maximun_goal_amount = $maximun_goal_amount;
        $this->maximun_funds_amount = $maximun_funds_amount;
        $this->minimum_funds_amount = $minimum_funds_amount;
    }

    
    public function render()
    {
        $economic_goals = EconomicGoal::where('user_id', auth()->id())
            ->when($this->goal_name, function($query){
                $query->where('goal_name', 'LIKE', "%" . $this->goal_name . "%");
            })
            ->when($this->start_date, function ($query) {
                $query->where('start_date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                $query->where('deadline', '<=', $this->end_date);
            })
            ->when($this->minimum_goal_amount, function($query) {
                $query->where('goal_amount', '>=', $this->minimum_goal_amount);
            })
            ->when($this->maximun_goal_amount, function($query) {
                $query->where('goal_amount', '<=', $this->maximun_goal_amount);
            })
            ->when($this->minimum_funds_amount, function($query) {
                $query->where('funds_deposited', '>=', $this->minimum_funds_amount);
            })
            ->when($this->maximun_funds_amount, function($query) {
                $query->where('funds_deposited', '<=', $this->maximun_funds_amount);
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('livewire.economic-goal.show-economic-goals', [
            'economic_goals' => $economic_goals,
        ]);
    }
}
