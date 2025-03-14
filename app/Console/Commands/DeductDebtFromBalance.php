<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Owner;
use App\Models\Debt;
use App\Models\Transaction;
use Carbon\Carbon;

class DeductDebtFromBalance extends Command
{
    protected $signature = 'debt:deduct-from-balance';
    protected $description = 'Automatically deduct debts from owner balances';

    public function handle()
    {
        $today = Carbon::now()->startOfDay();
        $debts = Debt::where('status', 0)->whereDate('created_at', '<=', $today)->get();

        foreach ($debts as $debt) {
            $owner = $debt->comunal->owner;

            if ($owner && $owner->balance >= $debt->total_amount) {
                // Deduct debt from owner balance
                $owner->balance -= $debt->total_amount;
                $owner->save();

                // Mark debt as paid
                $debt->status = 1;
                $debt->save();

                // Log the transaction
                Transaction::create([
                    'owner_id' => $owner->id,
                    'debt_id' => $debt->id,
                    'amount' => $debt->total_amount,
                    'type' => 'debt_payment',
                ]);

                $this->info("Debt ID: {$debt->id} paid using owner balance (owner ID: {$owner->id})");
            }
        }

        $this->info('Debt balance deduction process completed.');
    }
}
