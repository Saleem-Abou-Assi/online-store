<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('show-product', function (User $user) {
            return 'admin'=== $user->name;
        });
        Gate::define('create-product', function (User $user) {
            return 'admin'=== $user->name;
        });
        Gate::define('delete-product', function (User $user) {
            return 'admin'=== $user->name;
        });
        Gate::define('update-product', function (User $user) {
            return 'admin'=== $user->name;
        });
    }
}
