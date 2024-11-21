<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Income;
use App\Models\Outcome;
use Carbon\Carbon;
use Livewire\Component;

class Transactions extends Component
{
    public $categorie_id;
    public $start_date;
    public $end_date;
    public $minimum_amount;
    public $maximun_amount;
    public $total_income;
    public $total_outcome;
    public $remaining_money;
    public $percentage;

    protected $listeners = ['dataTerms' => 'search', 'incomeDeleted' => 'refreshTotals', 'outcomeDeleted' => 'refreshTotals'];

    public function search($categorie_id, $start_date, $end_date, $minimum_amount, $maximun_amount) {
        $this->categorie_id = $categorie_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->minimum_amount = $minimum_amount;
        $this->maximun_amount = $maximun_amount;
    }

    private function calculateTotal($model, $amountField, $dateField) {
        return $model::where('user_id', auth()->user()->id)
            ->when($this->categorie_id, function ($query) {
                $query->where('categorie_id', $this->categorie_id);
            })
            ->when($this->start_date, function ($query) use ($dateField) {
                $query->where($dateField, '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) use ($dateField) {
                $query->where($dateField, '<=', $this->end_date);
            })
            ->when($this->minimum_amount, function ($query) use ($amountField) {
                $query->where($amountField, '>=', $this->minimum_amount);
            })
            ->when($this->maximun_amount, function ($query) use ($amountField) {
                $query->where($amountField, '<=', $this->maximun_amount);
            })
            ->sum($amountField);
    }


    public function refreshTotals()
    {
        if (!$this->start_date) {
            $this->start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
        }
        $this->total_income = $this->calculateTotal(Income::class, 'income_amunt', 'income_date');
        $this->total_outcome = $this->calculateTotal(Outcome::class, 'outcome_amount', 'outcome_date');
        $this->remaining_money = $this->total_income - $this->total_outcome;

        $this->percentage = ($this->total_income > 0) ? (100 - ($this->total_outcome / $this->total_income) * 100) : 100;
    }


    public function render()
    {
        $this->refreshTotals();

        return view('livewire.transactions', [
            'remaining_money' => $this->remaining_money,
            'total_income' => $this->total_income,
            'total_outcome' => $this->total_outcome,
            'percentage' => $this->percentage,
        ]);
    }
}
