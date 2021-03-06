<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(PostsTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PhoneNumberSeeder::class);
        $this->call(DogsTableSeeder::class);
    }
}
