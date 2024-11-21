<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use Illuminate\Http\Request;
use App\Traits\handlesEconomicGoals;

class OutcomeController extends Controller
{
    use handlesEconomicGoals;

    public function __construct()
    {
        $this->checkAndNotifyEconomicGoals();
    }

    public function index(){
        $currentRoute = request()->route()->getName();
        return view('outcomes.index', compact('currentRoute'));
    }

    public function create(){
        return view('outcomes.create');
    }

    public function show(Outcome $outcome){
        return view('outcomes.show', [
            'outcome' => $outcome
        ]);
    }
    
    public function edit(Outcome $outcome){
        return view('outcomes.edit', [
            'outcome' => $outcome
        ]);
    }

}
