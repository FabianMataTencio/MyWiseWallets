<?php

namespace App\Livewire\EconomicGoal;

use App\Models\Categorie;
use Livewire\Component;
use App\Models\EconomicGoal;
use Illuminate\Support\Carbon;

class EditEconomicGoal extends Component
{
    public $goal_id;
    public $goal_name;
    public $start_date;
    public $deadline;
    public $goal_description;
    public $cash_folow_id;
    public $goal_amount;

    protected $rules = [
        'goal_name' => 'required|string|max:60',
        'start_date' => 'required|date',
        'deadline' => 'required|date',
        'goal_description' => 'required|string|max:255',
        'cash_folow_id' => 'required|integer|in:6,7',
        'goal_amount' => 'required|numeric|min:0.01|max:9999999.99',
    ];

    public function mount(EconomicGoal $economic_goal){
        $this->goal_id = $economic_goal->id;
        $this->goal_name = $economic_goal->goal_name;
        $this->start_date = Carbon::parse($economic_goal->start_date)->format('Y-m-d');
        $this->deadline = Carbon::parse($economic_goal->deadline)->format('Y-m-d');
        $this->goal_description = $economic_goal->goal_description;
        $this->cash_folow_id = $economic_goal->cash_folow_id;
        $this->goal_amount = $economic_goal->goal_amount;
    }

    public function editEconomicGoal(){
        $data = $this->validate();

        $economic_goal = EconomicGoal::find($this->goal_id);

        if($economic_goal->goal_name != $this->goal_name){
            $categorie = Categorie::where('id', $economic_goal->categorie_id)->first();
            $categorie->categoria = $data["goal_name"];
            $categorie->save();
        }

        $economic_goal->goal_name = $data["goal_name"];
        $economic_goal->start_date = $data["start_date"];
        $economic_goal->deadline = $data["deadline"];
        $economic_goal->goal_description = $data["goal_description"];
        $economic_goal->cash_folow_id = $data["cash_folow_id"];
        $economic_goal->goal_amount = $data["goal_amount"];

        $today = now()->startOfDay();
        $deadline = $economic_goal->deadline->startOfDay();
        if ($today->isBefore($deadline)) {
            if ($economic_goal->cash_folow_id == 6 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                $economic_goal->state_id = 2;
                $economic_goal->save();
            } elseif ($economic_goal->cash_folow_id == 7 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                $economic_goal->state_id = 1;
                $economic_goal->save();
            } else {
                $economic_goal->state_id = 3;
                $economic_goal->save();
            } 
        } elseif ($today->isAfter($deadline)) {
            if ($economic_goal->cash_folow_id == 6 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                $economic_goal->state_id = 2;
                $economic_goal->save();
            } elseif ($economic_goal->cash_folow_id == 7 && $economic_goal->goal_amount >= $economic_goal->funds_deposited) {
                $economic_goal->state_id = 2;
                $economic_goal->save();
            } else {
                $economic_goal->state_id = 1;
                $economic_goal->save();
            } 
        }
        return redirect()->route('economicgoals.index')->with('message', __('Economic goal updated successfully!'));
    }

    public function render()
    {
        return view('livewire.economic-goal.edit-economic-goal');
    }
}
