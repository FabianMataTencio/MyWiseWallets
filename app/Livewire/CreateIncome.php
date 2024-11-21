<?php

namespace App\Livewire;

use App\Models\Income;
use Livewire\Component;
use App\Models\Categorie;
use App\Models\Cash_Folow;
use App\Models\EconomicGoal;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateIncome extends Component
{
    public $income_amount;
    public $categorie_id;
    public $cash_folow_id;
    public $income_date;
    public $income_description;
    public $image;

    use WithFileUploads;

    protected $rules = [
        'income_amount' => 'required|numeric|min:0.01|max:9999999.99',
        'categorie_id' => 'required|integer',
        'cash_folow_id' => 'required|integer|in:1,2,3,4,5',
        'income_date' => 'required',
        'income_description' => 'required|string|max:300',
        'image' => 'nullable|image|max:1024'
    ];


    public function render()
    {
        $categories = Categorie::where('user_id', auth()->id())
                                ->where('types_categories_id', '<>', 2)
                                ->get();
        return view('livewire.create-income',[ 
            'categories' => $categories, 
        ]);
    }


    public function createIncome(){
        $data = $this->validate();

        $image_name = null; 

        if ($this->image) {  
            $image = $this->image->store('incomes', 'public');
            $image_name = str_replace('incomes/', '', $image);
        }

        Income::create([
            'income_description' => $data['income_description'], 
            'income_amunt' => $data['income_amount'],
            'income_date' => $data['income_date'],
            'image' => $image_name,
            'user_id' => auth()->id(),
            'categorie_id' => $data['categorie_id'],
            'cash_folow_id' => $data['cash_folow_id'],
        ]);

        $categorie = Categorie::find($this->categorie_id);

        if ($categorie && $categorie->types_categories_id == 3) {
            $economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $economic_goal->funds_deposited += $data['income_amount']; 
            $economic_goal->save(); 
            
        }

        return redirect()->route('incomes.index')->with('message', __('Income created successfully!'));

    }
}
