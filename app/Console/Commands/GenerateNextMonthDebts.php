<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comunal;
use App\Models\Debt;
use Carbon\Carbon;

class GenerateNextMonthDebts extends Command
{
    protected $signature = 'debts:generate-next-month';
    protected $description = 'Generate debts for each Comunal exactly one month after the last debt creation';

    public function handle()
    {
        $today = Carbon::now()->startOfDay();

        // Get all Comunal records
        $comunals = Comunal::all();

        foreach ($comunals as $comunal) {
            // Find the most recent Debt entry for this Comunal
            $lastDebt = Debt::where('comunal_id', $comunal->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastDebt) {
                // Calculate the next due date (one month after the last debt creation)
                $nextDueDate = Carbon::parse($lastDebt->created_at)->addMonth()->startOfDay();

                // If today matches the next due date, create a new debt
                if ($today->equalTo($nextDueDate)) {
                    Debt::create([
                        'comunal_id'        => $comunal->id,
                        'calculated_amount' => $this->calculateDebtAmount($comunal),
                        'discount_amount'   => $comunal->has_discount ? ($comunal->discount_percent / 100) * $this->calculateDebtAmount($comunal) : 0,
                        'discount_percent'  => $comunal->discount_percent ?? 0,
                        'total_amount'      => $this->calculateDebtAmount($comunal) - ($comunal->has_discount ? ($comunal->discount_percent / 100) * $this->calculateDebtAmount($comunal) : 0),
                        'created_at'        => $today,
                        'updated_at'        => Carbon::now(),
                    ]);

                    $this->info("Debt created for Comunal ID: {$comunal->id} on {$today->toDateString()}");
                }
            }
        }

        $this->info('Next month debts checked and generated where necessary.');
    }

    private function calculateDebtAmount(Comunal $comunal)
    {
        $calculated_amount = 0;
        $complex = $comunal->complex;

        if ($complex) {
            if ($comunal->apartment) {
                $calculated_amount = $comunal->apartment->living_area * $complex->residential_price;
            } elseif ($comunal->object) {
                $calculated_amount = $comunal->object->size * $complex->non_residential_price;
            } elseif ($comunal->garage) {
                $calculated_amount = $comunal->garage->size * $complex->garage_price;
            }
        }

        return $calculated_amount;
    }
}
