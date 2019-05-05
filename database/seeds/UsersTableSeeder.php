<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Contact;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        // factory(User::class, 10)->create()->each(function($user){
        //     $user->contacts()->saveMany(factory(Contact::class, 10)->create()->make());
        // });
    }
}
