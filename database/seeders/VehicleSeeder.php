<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Faker\Provider\Fakecar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new Fakecar($faker));

        for ($i = 0; $i < 100; $i++) {
            $fakeDate = $faker->dateTimeBetween(now()->startOfDay(), now()->addDay()->endOfDay());

            $newVehicle = new Vehicle;
            $newVehicle->type_id = random_int(1, 7);
            $newVehicle->name = $faker->vehicle;
            $newVehicle->reg_no = $this->generateRandomString() . random_int(1000, 9999) . $this->generateRandomString(random_int(1, 3));
            $newVehicle->created_at = $fakeDate;
            $newVehicle->updated_at = $fakeDate;
            $newVehicle->save();
        }
    }

    private function generateRandomString($length = 1)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
