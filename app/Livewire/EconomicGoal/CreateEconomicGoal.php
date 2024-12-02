<?php

namespace App\Livewire\EconomicGoal;

use App\Models\Categorie;
use App\Models\EconomicGoal;
use Livewire\Component;

class CreateEconomicGoal extends Component
{
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

    public function render()
    {
        return view('livewire.economic-goal.create-economic-goal');
    }

    public function createEconomicGoal()
    {
        $data = $this->validate();

        $category = Categorie::create([
            'categoria' => $data['goal_name'],
            'user_id' => auth()->id(),
            'types_categories_id' => 3,
        ]);

        EconomicGoal::create([
            'goal_name' => $data['goal_name'],
            'goal_description' => $data['goal_description'],
            'start_date' => $data['start_date'],
            'deadline' => $data['deadline'],
            'goal_amount' => $data['goal_amount'],
            'funds_deposited' => 0,
            'user_id' => auth()->id(),
            'categorie_id' => $category->id,
            'cash_folow_id' => $data['cash_folow_id'],
            'state_id' => 3,
        ]);

        return redirect()->route('economicgoals.index')->with('message', __('Economic goal created successfully!'));
    }
}
