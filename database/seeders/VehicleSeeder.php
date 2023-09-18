<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'title' => 'Sedan',
                'model' => 'Toyota Camry',
                'user_id' => 3,
                'mileage' => 50000,
                'transmission' => 'manual',
                'price' => 20000.00,
            ],
            [
                'title' => 'SUV',
                'model' => 'Ford Explorer',
                'user_id' => 3,
                'mileage' => 35000,
                'transmission' => 'automatic',
                'price' => 30000.00,
            ],
            [
                'title' => 'Vigo',
                'model' => 'Toyota',
                'user_id' => 3,
                'mileage' => 35000,
                'transmission' => 'manual',
                'price' => 30000.00,
            ],
            [
                'title' => 'Fortuner',
                'model' => 'Toyota',
                'user_id' => 3,
                'mileage' => 35000,
                'transmission' => 'automatic',
                'price' => 30000.00,
            ],
            // Add more vehicles as needed
        ];

        foreach ($vehicles as $vehicleData) {
            Vehicle::create($vehicleData);
        }
    }
}
