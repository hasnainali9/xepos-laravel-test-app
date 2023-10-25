<?php

namespace App\Providers;

use App\Services\CompanyService;
use App\Services\EmployeeService;
use Illuminate\Support\ServiceProvider;
use App\Services\AuthService;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });
        $this->app->bind(CompanyService::class, function ($app) {
            return new CompanyService();
        });
        $this->app->bind(EmployeeService::class, function ($app) {
            return new EmployeeService();
        });

        inertia::share('errors', function () {
            return session()->get('errors') ? session()->get('errors')->getbag('default')->getmessages() : (object) [];
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
