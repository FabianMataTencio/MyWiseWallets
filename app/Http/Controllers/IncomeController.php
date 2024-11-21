<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\EconomicGoal;
use Illuminate\Http\Request;
use App\Traits\handlesEconomicGoals;
use App\Notifications\EconomicGoalNotification;

class IncomeController extends Controller
{
    use handlesEconomicGoals;

    public function __construct()
    {
        $this->checkAndNotifyEconomicGoals();
    }


    public function index(){
        $currentRoute = request()->route()->getName();
        return view('incomes.index', compact('currentRoute'));
    }

    public function create(){
        return view('incomes.create');
    }

    public function show(Income $income){
        return view('incomes.show', [
            'income' => $income
        ]);
    }

    public function edit(Income $income){
        return view('incomes.edit', [
            'income' => $income
        ]);
    }
}
