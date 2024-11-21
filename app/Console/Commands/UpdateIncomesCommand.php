<?php

namespace App\Console\Commands;

use App\Models\Income;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class UpdateIncomesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-incomes-command';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically update incomes based on their cash_folow type';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $incomes = Income::where('active', true)->get();
        foreach ($incomes as $income) {
            $nextIncomeDate = $this->calculateNextIncomeDate($income);

            if (Carbon::now()->greaterThanOrEqualTo($nextIncomeDate)) {
                $income->update(['active' => false]);
                Income::create([
                    'income_description' => $income->income_description,
                    'income_amount' => $income->income_amount,
                    'income_date' => $nextIncomeDate,
                    'image' => $income->image,
                    'user_id' => $income->user_id,
                    'categorie_id' => $income->categorie_id,
                    'cash_folow_id' => $income->cash_folow_id,
                    'active' => true,
                ]);
                
            }
        }
    }

    private function calculateNextIncomeDate(Income $income)
    {
        $nextDate = null;
        switch ($income->cash_folow_id) {
            case 1: // Unique
                $nextDate = $income->income_date;
                break;
            case 2: // Daily
                $nextDate = Carbon::parse($income->income_date)->addDay();
                break;
            case 3: // weekly
                $nextDate = Carbon::parse($income->income_date)->addWeek();
                break;
            case 4: // mothly
                $nextDate = Carbon::parse($income->income_date)->addMonth();
                break;
            case 5: // Annually
                $nextDate = Carbon::parse($income->income_date)->addYear();
                break;
        }

        return $nextDate;
    }
}
