<?php

namespace App\Livewire;

use App\Models\Income;
use Livewire\Component;
use App\Models\Categorie;
use Livewire\Attributes\On;
use App\Models\EconomicGoal;
use Illuminate\Support\Carbon;

class ShowIncomes extends Component
{
    public $categorie_id;
    public $start_date;
    public $end_date;
    public $minimum_amount;
    public $maximun_amount;

    protected $listeners = ['dataTerms' => 'search'];

    protected $liseners = ['deleteIncome'];

    #[On('deleteIncome')]

    public function deleteIncome(Income $income){
        $incomecome_categorie = Categorie::find($income->categorie_id);
        if($incomecome_categorie->types_categories_id == 3){
            $economic_goal = EconomicGoal::where('categorie_id', $incomecome_categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited - $income->income_amunt; 
            $economic_goal->save();
        }
        $income->delete();
        $this->dispatch('incomeDeleted');
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
            if ($category && $category->types_categories_id !== 1) {
                $this->categorie_id = null;
            }
        }

        if(!$this->start_date){
            $this->start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        }

        $incomes = Income::where('user_id', auth()->user()->id)
        ->when($this->categorie_id, function($query) {
            $query->where('categorie_id', $this->categorie_id);
        })
        ->when($this->start_date, function ($query) {
            $query->where('income_date', '>=', $this->start_date);
        })
        ->when($this->end_date, function ($query) {
            $query->where('income_date', '<=', $this->end_date);
        })
        ->when($this->minimum_amount, function($query) {
            $query->where('income_amunt', '>=', $this->minimum_amount);
        })
        ->when($this->maximun_amount, function($query) {
            $query->where('income_amunt', '<=', $this->maximun_amount);
        })
        ->orderBy('income_date', 'desc')
        ->paginate(15);

        return view('livewire.show-incomes', [
            'incomes' => $incomes
        ]);
    }

    
}
