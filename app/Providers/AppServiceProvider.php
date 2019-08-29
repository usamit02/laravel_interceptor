<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;

use Laravel\Passport\Passport;//+
use Illuminate\Support\Facades\Gate;//+
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;//+

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\User' => 'App\Policies\UserPolicy',
    ];//+
    public function boot()
    {
        $this->registerPolicies();//+
        Passport::routes();//+
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
