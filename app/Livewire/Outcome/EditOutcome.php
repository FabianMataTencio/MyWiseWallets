<?php

namespace App\Livewire\Outcome;

use App\Models\Outcome;
use Livewire\Component;
use App\Models\Categorie;
use App\Models\Cash_Folow;
use App\Models\EconomicGoal;
use Illuminate\Support\Carbon;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditOutcome extends Component
{
    public $outcome_id;
    public $outcome_amount;
    public $categorie_id;
    public $cash_folow_id;
    public $outcome_date;
    public $outcome_description;
    public $new_image;
    public $image;

    use WithFileUploads;

    protected $rules = [
        'outcome_amount' => 'required|numeric|min:0.01|max:9999999.99',
        'categorie_id' => 'required|integer',
        'cash_folow_id' => 'required|integer|in:1,2,3,4,5',
        'outcome_date' => 'required',
        'outcome_description' => 'required|string|max:300',
        'new_image' => 'nullable|image|max:1024'
    ];
    
    public function mount(Outcome $outcome){
        $this->outcome_id = $outcome->id;
        $this->outcome_amount = $outcome->outcome_amount;
        $this->categorie_id = $outcome->categorie_id;
        $this->cash_folow_id = $outcome->cash_folow_id;
        $this->outcome_date = Carbon::parse($outcome->outcome_date)->format('Y-m-d');
        $this->outcome_description = $outcome->outcome_description;
        $this->image = $outcome->image;
    }

    public function editOutcome(){

        $data = $this->validate();

        if($this->new_image){
            $image = $this->new_image->store('outcomes', 'public');
            $data['image'] = str_replace('outcomes/' , '', $image);
        }

        $outcome = Outcome::find($this->outcome_id);

        $categorie = Categorie::find($this->categorie_id);

        $outcome_categorie = Categorie::find($outcome->categorie_id);

        if ($categorie->types_categories_id == 3 && $outcome_categorie->types_categories_id != 3) {
            $economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited + $data['outcome_amount']; 
            $economic_goal->save(); 
        } elseif($categorie->types_categories_id == 1 && $outcome_categorie->types_categories_id == 3){
            $economic_goal = EconomicGoal::where('categorie_id', $outcome_categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited - $outcome->outcome_amount; 
            $economic_goal->save();
        }elseif ($categorie->types_categories_id == 3 && $categorie->id == $outcome_categorie->id) {
            $economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $economic_goal->funds_deposited = $economic_goal->funds_deposited -$outcome->outcome_amount + $data['outcome_amount']; 
            $economic_goal->save(); 
        }elseif ($categorie->types_categories_id == 3 && $categorie->id != $outcome_categorie->id){
            $new_economic_goal = EconomicGoal::where('categorie_id', $categorie->id)->first(); 
            $old_economic_goal = EconomicGoal::where('categorie_id', $outcome_categorie->id)->first(); 
            $new_economic_goal->funds_deposited = $new_economic_goal->funds_deposited + $data['outcome_amount'];  
            $old_economic_goal->funds_deposited = $old_economic_goal->funds_deposited - $outcome_categorie->outcome_amount; 
            $new_economic_goal->save(); 
            $old_economic_goal->save();
        }

        $outcome->outcome_amount = $data['outcome_amount'];
        $outcome->categorie_id = $data['categorie_id'];
        $outcome->cash_folow_id = $data['cash_folow_id'];
        $outcome->outcome_date = $data['outcome_date'];
        $outcome->outcome_description = $data['outcome_description'];
        $outcome->image = $data['image'] ?? $outcome->image;

        $outcome->save();

        return redirect()->route('outcomes.index')->with('message', __('Outcome updated successfully!'));
    }

    public function render()
    {
        $categories = Categorie::where('user_id', auth()->user()->id)
                                ->where('types_categories_id','<>', 1)
                                ->get();
        return view('livewire.outcome.edit-outcome', [
            'categories' => $categories,
        ]);
    }
}
