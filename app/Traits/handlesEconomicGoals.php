<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\EconomicGoal;
use App\Notifications\EconomicGoalNotification;

trait handlesEconomicGoals
{
    public function checkAndNotifyEconomicGoals()
    {
        $economic_goals = EconomicGoal::where('user_id', auth()->id())
                                      ->where('state_id', 3)
                                      ->get();
        $today = now()->startOfDay();

        foreach ($economic_goals as $economic_goal) {
            $deadline = $economic_goal->deadline->startOfDay();

            if ($today->isBefore($deadline)) {
                if ($economic_goal->cash_folow_id == 6 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                    $economic_goal->user->notify(new EconomicGoalNotification($economic_goal->id, $economic_goal->goal_name, 3, $economic_goal->user_id));
                    $economic_goal->state_id = 2;
                } elseif ($economic_goal->cash_folow_id == 7 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                    $economic_goal->user->notify(new EconomicGoalNotification($economic_goal->id, $economic_goal->goal_name, 4, $economic_goal->user_id));
                    $economic_goal->state_id = 1;
                } else {
                    $economic_goal->state_id = 3;
                }
            } elseif ($today->isAfter($deadline)) {
                if ($economic_goal->cash_folow_id == 6 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                    $economic_goal->user->notify(new EconomicGoalNotification($economic_goal->id, $economic_goal->goal_name, 1, $economic_goal->user_id));
                    $economic_goal->state_id = 2;
                } elseif ($economic_goal->cash_folow_id == 7 && $economic_goal->goal_amount >= $economic_goal->funds_deposited) {
                    $economic_goal->user->notify(new EconomicGoalNotification($economic_goal->id, $economic_goal->goal_name, 1, $economic_goal->user_id));
                    $economic_goal->state_id = 2;
                } else {
                    $economic_goal->user->notify(new EconomicGoalNotification($economic_goal->id, $economic_goal->goal_name, 2, $economic_goal->user_id));
                    $economic_goal->state_id = 1;
                }
            }

            $economic_goal->save();
        }
    }


    public function checkAndUpdateEconomicGoalsState()
    {
        $economic_goals = EconomicGoal::where('user_id', auth()->id())
                                      ->get();
        $today = now()->startOfDay();

        foreach ($economic_goals as $economic_goal) {
            $deadline = $economic_goal->deadline->startOfDay();

            if ($today->isBefore($deadline)) {
                if ($economic_goal->cash_folow_id == 6 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                    $economic_goal->state_id = 2;
                } elseif ($economic_goal->cash_folow_id == 7 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                    $economic_goal->state_id = 1;
                } else {
                    $economic_goal->state_id = 3;
                }
            } elseif ($today->isAfter($deadline)) {
                if ($economic_goal->cash_folow_id == 6 && $economic_goal->goal_amount <= $economic_goal->funds_deposited) {
                    $economic_goal->state_id = 2;
                } elseif ($economic_goal->cash_folow_id == 7 && $economic_goal->goal_amount >= $economic_goal->funds_deposited) {
                    $economic_goal->state_id = 2;
                } else {
                    $economic_goal->state_id = 1;
                }
            }

            $economic_goal->save();
        }
    }
}
