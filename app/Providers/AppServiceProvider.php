<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Laravel\Sanctum\Sanctum;
use App\Models\PersonalAccessToken;

use App\Models\Login_User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Gate::define('isSuperAdmin', function(Login_User $user) {
            return $user->user_role == 1;
        });
        
        Gate::define('isAdmin', function(Login_User $user) {
            return $user->user_role == 2;
        });
        
        Gate::define('user', function(Login_User $user, $id) {
            return $user->user_id == $id;
        });
        
        Gate::define('authCompany', function(Login_User $user, $id) {
            return $user->company_id == $id;
        });
        
        Gate::define('currentCompany', function(Company_Detail $company, $domain) {
            return $company->domain == $domain;
        });
    }
}
