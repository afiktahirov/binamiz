<?php

namespace App\Observers;

use App\Models\Comunal;
use App\Models\Debt;
use App\Models\Complex;
use App\Models\Apartment;
use App\Models\Obyekt;
use App\Models\Garage;
use Carbon\Carbon;

class ComunalObserver
{
    /**
     * Handle the Comunal "created" event.
     */
    public function created(Comunal $comunal)
    {
        if($comunal->apartment_id)
            $comunal->owner_id = $comunal->apartment?->owner_id;
            
        else if($comunal->garage_id)
            $comunal->owner_id = $comunal->garage?->owner_id;
            
        else if($comunal->object_id) 
            $comunal->owner_id = $comunal->object?->owner_id;
        
        $comunal->save();
            
        $this->createDebtForComunal($comunal);
    }

    /**
     * Handle the Comunal "updated" event.
     */
    public function updated(Comunal $comunal)
    {
        Debt::updateOrCreate(
            ['comunal_id' => $comunal->id, 'created_at' => Carbon::now()->startOfMonth()],
            $this->calculateDebt($comunal)
        );
    }

    /**
     * Creates the first debt for a new Comunal.
     */
    private function createDebtForComunal(Comunal $comunal)
    {
        Debt::create($this->calculateDebt($comunal));
    }

    /**
     * Calculates debt based on the Comunal's related data.
     */
    private function calculateDebt(Comunal $comunal)
    {
        $calculated_amount = 0;
        $discount_amount = 0;
        $discount_percent = 0;
        $total_amount = 0;

        $apartment = Apartment::find($comunal->apartment_id);
        $obyekt = Obyekt::find($comunal->obyekt_id);
        $garage = Garage::find($comunal->garage_id);
        $complex = Complex::find($comunal->complex_id);

        if ($complex) {
            if ($apartment) {
                $calculated_amount = $apartment->living_area * $complex->residential_price;
            } elseif ($obyekt) {
                $calculated_amount = $obyekt->size * $complex->non_residential_price;
            } elseif ($garage) {
                $calculated_amount = $garage->size * $complex->garage_price;
            }
        }

        if ($comunal->has_discount == 1) {
            $discount_percent = $comunal->discount_percent;
            $discount_amount = ($calculated_amount * $discount_percent) / 100;
        }

        $total_amount = $calculated_amount - $discount_amount;

        return [
            'comunal_id'        => $comunal->id,
            'calculated_amount' => $calculated_amount,
            'discount_amount'   => $discount_amount,
            'discount_percent'  => $discount_percent,
            'total_amount'      => $total_amount,
            'created_at'        => Carbon::now()->startOfMonth(), // Ensures it is marked for the current month
            'updated_at'        => Carbon::now(),
        ];
    }
}
