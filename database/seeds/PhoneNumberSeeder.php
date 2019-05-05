<?php

use Illuminate\Database\Seeder;
use App\PhoneNumber;

class PhoneNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PhoneNumber::class, 20)->create();
    }
}
