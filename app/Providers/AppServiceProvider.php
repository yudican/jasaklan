<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yudican\LaravelCrudGenerator\LaravelCrudGeneratorServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(LaravelCrudGeneratorServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
