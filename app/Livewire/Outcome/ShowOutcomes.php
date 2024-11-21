<?php

namespace App\Livewire\Outcome;

use App\Models\Outcome;
use Livewire\Component;
use App\Models\Categorie;
use Livewire\Attributes\On;
use App\Models\EconomicGoal;
use Illuminate\Support\Carbon;

class ShowOutcomes extends Component
{
    public $categorie_id;
    public $start_date;
    public $end_date;
    public $minimum_amount;
    public $maximun_amount;

    protected $listeners = ['dataTerms' => 'search'];

    protected $liseners = ['deleteOutcome'];

    #[On('deleteOutcome')]

    public function deleteOutcome(Outcome $outcome){
        $outcome_categorie = Categorie::find($outcome->categorie_id);
        if($outcome_categorie->types_categories_id == 3){
            $economic_goal = EconomicGoal::where('categorie_id', $outcome_categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited - $outcome->outcome_amount; 
            $economic_goal->save();
        }
        $outcome->delete();
        $this->dispatch('outcomeDeleted');
    }  

    public function search($categorie_id, $start_date, $end_date, $minimum_amount, $maximun_amount ){
        $this->categorie_id = $categorie_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->minimum_amount = $minimum_amount;
        $this->maximun_amount = $maximun_amount;
    }

    public function render()
    {
        if ($this->categorie_id) {
            $category = Categorie::find($this->categorie_id);
            if ($category && $category->types_categories_id !== 2) {
                $this->categorie_id = null;
            }
        }

        if(!$this->start_date){
            $this->start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        }

        $outcomes = Outcome::where('user_id', auth()->user()->id)
        ->when($this->categorie_id, function($query) {
            $query->where('categorie_id', $this->categorie_id);
        })
        ->when($this->start_date, function ($query) {
            $query->where('outcome_date', '>=', $this->start_date);
        })
        ->when($this->end_date, function ($query) {
            $query->where('outcome_date', '<=', $this->end_date);
        })
        ->when($this->minimum_amount, function($query) {
            $query->where('outcome_amount', '>=', $this->minimum_amount);
        })
        ->when($this->maximun_amount, function($query) {
            $query->where('outcome_amount', '<=', $this->maximun_amount);
        })
        ->orderBy('outcome_date', 'desc')
        ->paginate(15);

        return view('livewire.outcome.show-outcomes', [
            'outcomes' => $outcomes
        ]);
    }
}
