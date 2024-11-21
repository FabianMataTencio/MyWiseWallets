<?php

namespace App\Http\Controllers;

use App\Models\EconomicGoal;
use App\Traits\handlesEconomicGoals;
use Illuminate\Http\Request;

class EconomicGoalController extends Controller
{
    use handlesEconomicGoals;

    public function __construct()
    {
        $this->checkAndUpdateEconomicGoalsState();
    }

    public function index(){
        return view('economicgoals.index');
    }

    public function create(){
        return view('economicgoals.create');
    }

    public function show(EconomicGoal $economic_goal){
        return view('economicgoals.show', [
            'economic_goal' => $economic_goal,
        ]);
    }

    public function edit(EconomicGoal $economic_goal){
        return view('economicgoals.edit', [
            'economic_goal' => $economic_goal,
        ]);
    }
}
