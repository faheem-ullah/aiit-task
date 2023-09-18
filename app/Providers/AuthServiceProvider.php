<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */ 

    protected $policies = [];
    

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
         });
 
         Gate::define('isBuyer', function($user) {
             return $user->role == 'buyer';
         });
 
         Gate::define('isSeller', function($user) { 
             return $user->role == 'seller';
         });
    }
}
