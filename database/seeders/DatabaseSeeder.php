<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\VehicleBrand;
use App\Models\VehicleColor;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $now = now();

        // VehicleColor::insert([
        //     ['name' => 'Qara', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Ağ', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Boz', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Mavi', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Yaşıl', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Qırmızı', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Narıncı', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Bənövşəyi', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Gümüşü', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Qəhvəyi', 'created_at' => $now, 'updated_at' => $now],
        // ]);

        // VehicleBrand::insert([
        //     ['name' => 'Toyota', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Honda', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Ford', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Chevrolet', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Nissan', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'BMW', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Mercedes-Benz', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Volkswagen', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Hyundai', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Kia', 'created_at' => $now, 'updated_at' => $now],
        // ]);

        // VehicleType::insert([
        //     ['name' => 'Sedan', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Hatchback', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'SUV', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Crossover', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Pickup', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Minivan', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Coupe', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Convertible', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Wagon', 'created_at' => $now, 'updated_at' => $now],
        //     ['name' => 'Sports Car', 'created_at' => $now, 'updated_at' => $now],
        // ]);
    }
}
