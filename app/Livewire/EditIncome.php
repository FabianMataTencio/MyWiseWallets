<?php

namespace App\Livewire;

use App\Models\Income;
use Livewire\Component;
use App\Models\Categorie;
use App\Models\Cash_Folow;
use App\Models\EconomicGoal;
use Illuminate\Support\Carbon;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditIncome extends Component
{
    public $income_id;
    public $income_amount;
    public $categorie_id;
    public $cash_folow_id;
    public $income_date;
    public $income_description;
    public $image;
    public $new_image;

    use WithFileUploads;

    protected $rules = [
        'income_amount' => 'required|numeric|min:0.01|max:9999999.99',
        'categorie_id' => 'required|integer',
        'cash_folow_id' => 'required|integer|in:1,2,3,4,5',
        'income_date' => 'required',
        'income_description' => 'required|string|max:300',
        'new_image' => 'nullable|image|max:1024'
    ];
    
    public function mount(Income $income){
        $this->income_id = $income->id;
        $this->income_amount = $income->income_amunt;
        $this->categorie_id = $income->categorie_id;
        $this->cash_folow_id = $income->cash_folow_id;
        $this->income_date = Carbon::parse($income->income_date)->format('Y-m-d');
        $this->income_description = $income->income_description;
        $this->image = $income->image;
    }

    public function editIncome(){
        $data = $this->validate();

        if($this->new_image){
            $image = $this->new_image->store('incomes', 'public');
            $data['image'] = str_replace('incomes/', '', $image);
        }
        
        $income = Income::find($this->income_id);
        
        $categorie = Categorie::find($this->categorie_id);

        $income_categorie = Categorie::find($income->categorie_id);
        //These block of if, is for update de economic goal if it is involucrate with the income update
        if ($categorie->types_categories_id == 3 && $income_categorie->types_categories_id != 3) {
            $economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited + $data['income_amount']; 
            $economic_goal->save(); 
        } elseif($categorie->types_categories_id == 1 && $income_categorie->types_categories_id == 3){
            $economic_goal = EconomicGoal::where('categorie_id', $income_categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited -$income->income_amunt; 
            $economic_goal->save();
        } elseif ($categorie->types_categories_id == 3 && $categorie->id == $income_categorie->id){
            $economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited -$income->income_amunt + $data['income_amount']; 
            $economic_goal->save(); 
        } elseif ($categorie->types_categories_id == 3 && $categorie->id != $income_categorie->id){
            $new_economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $old_economic_goal = EconomicGoal::where('categorie_id', $income_categorie->id)->first(); 
            $new_economic_goal->funds_deposited = $new_economic_goal->funds_deposited + $data['income_amount'];  
            $old_economic_goal->funds_deposited = $old_economic_goal->funds_deposited - $income->income_amunt; 
            $new_economic_goal->save(); 
            $old_economic_goal->save();
        }

        $income->income_description = $data['income_description'];
        $income->income_amunt = $data['income_amount'];
        $income->income_date = $data['income_date'];
        $income->image = $data['image'] ?? $income->image;
        $income->categorie_id = $data['categorie_id'];
        $income->cash_folow_id = $data['cash_folow_id'];
        
        $income->save();

        return redirect()->route('incomes.index')->with('message', __('Income updated successfully!'));
        
    }
    

    public function render()
    {
        $categories = Categorie::where('user_id', auth()->id())
                                ->where('types_categories_id', '<>', 2)
                                ->get();

        return view('livewire.edit-income',[ 
            'categories' => $categories, 
        ]);
    }
}
