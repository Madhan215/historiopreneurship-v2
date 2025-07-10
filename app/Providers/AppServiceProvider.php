<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        // Share user role to all views
        View::composer('*', function ($view) {
            // Tentukan role pengguna sementara
            $userRole = 'siswa'; // Siswa atau Guru
            $view->with('userRole', $userRole);
        });

        Gate::define('admin', function(User $user){
            return $user->peran == 'admin';
        });
        Schema::defaultStringLength(191);
    }
}
