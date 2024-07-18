<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('purge-tasks', function ($user) {
            return in_array($user->email, ['user1@laravelnagpur.com', 'user2@laravelnagpur.com']) ;
        });
        Model::unguard();
    }
}
