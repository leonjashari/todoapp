<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\GroupController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('App\Http\Controllers\RegisterController');
        
    }

    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
