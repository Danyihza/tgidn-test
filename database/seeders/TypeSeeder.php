<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Sedan',
            'MPV',
            'Truck',
            'SUV',
            'Crossover',
            'Hatchback',
            'Pickup',
        ];

        foreach ($types as $type) {
            $newType = new Type;
            $newType->name = $type;
            $newType->save();
        }
    }
}
