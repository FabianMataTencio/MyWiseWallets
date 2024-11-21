<?php

namespace App\Livewire\Outcome;

use App\Models\Income;
use App\Models\Outcome;
use Livewire\Component;
use App\Models\Categorie;
use App\Models\Cash_Folow;
use Livewire\Attributes\On;
use App\Models\EconomicGoal;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateOutcome extends Component
{
    public $outcome_amount;
    public $categorie_id;
    public $cash_folow_id;
    public $outcome_date;
    public $outcome_description;
    public $image;
    public $currentMonthIncome;
    public $currentMonthOutcome;
    public $remaining_money;
    public $confirmingOutcome = false;

    use WithFileUploads;

    protected $listeners = ['showConfirmOutcome', 'confirmOutcome'];


    protected $rules = [
        'outcome_amount' => 'required|numeric|min:0.01|max:9999999.99',
        'categorie_id' => 'required|integer',
        'cash_folow_id' => 'required|integer|in:1,2,3,4,5',
        'outcome_date' => 'required',
        'outcome_description' => 'required|string|max:300',
        'image' => 'nullable|image|max:1024'
    ];

    #[On('confirmOutcome')]

    public function render()
    {
        $categories = Categorie::where('user_id', auth()->user()->id)
                                ->where('types_categories_id', '<>', 1)
                                ->get();
        return view('livewire.outcome.create-outcome', [
            'categories' => $categories,
        ]);
    }

    public function createOutcome()
    {
        $this->validate();

        $currentMonthIncome = Income::where('user_id', auth()->id())
            ->whereMonth('income_date', now()->month)
            ->whereYear('income_date', now()->year)
            ->sum('income_amunt');

        $currentMonthOutcome = Outcome::where('user_id', auth()->id())
            ->whereMonth('outcome_date', now()->month)
            ->whereYear('outcome_date', now()->year)
            ->sum('outcome_amount');

        $remaining_money = $currentMonthIncome - $currentMonthOutcome;
        
        if ($this->outcome_amount > $remaining_money) {
            $this->confirmingOutcome = true;
            $this->dispatch('showConfirmOutcome');
        }else{
            $this->storeOutcome();
        }

    }

    public function storeOutcome()
    {   
        $data = $this->validate();
        $image_name = null;
        if ($this->image) {  
            $image = $this->image->store('outcomes', 'public');
            $image_name = str_replace('outcomes/', '', $image);
        }

        Outcome::create([
            'outcome_description' => $data['outcome_description'], 
            'outcome_amount' => $data['outcome_amount'],
            'outcome_date' => $data['outcome_date'],
            'image' => $image_name,
            'user_id' => auth()->id(),
            'categorie_id' => $data['categorie_id'],
            'cash_folow_id' => $data['cash_folow_id'],
        ]);

        $categorie = Categorie::find($this->categorie_id);

        if ($categorie && $categorie->types_categories_id == 3) {
            $economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $economic_goal->funds_deposited += $data['outcome_amount']; 
            $economic_goal->save(); 
        }

        return redirect()->route('outcomes.index')->with('message', __('Outcome created successfully!'));
    }

    public function confirmOutcome()
    {
        if ($this->confirmingOutcome) {
            $this->storeOutcome();
            $this->confirmingOutcome = false; 
        }
    }
}
