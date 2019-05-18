<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        // $this->registerPolicies();
        /**
         * Defining Authorization Rules
         * the boot() is the default plce to define one!
         * Authorization rule is called ability which is compromised of wtho things
         *          1. string
         *          2. closure //returns boolean. you could alse use class mehods just like route
         */
        // $this->registerPolicies($gate);
        // $gate->define('update-contact', function ($user, $contact){
        //     return $user->id === $contact->user_id;
        // });
        // Laravel\Passport\Passport::routes();
    }
}
