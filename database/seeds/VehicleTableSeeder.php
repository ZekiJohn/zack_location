<?php

use Illuminate\Database\Seeder;
use App\Vehicle;
class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vehicle::class, 50)->create();
    }
}
