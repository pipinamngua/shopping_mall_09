<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\InterfaceRepository\UserInterfaceRepository',
            'App\Repositories\EloquentRepository\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\InterfaceRepository\CategoryInterfaceRepository',
            'App\Repositories\EloquentRepository\CategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\InterfaceRepository\SizeInterfaceRepository',
            'App\Repositories\EloquentRepository\SizeRepository'
        );

        $this->app->bind(
            'App\Repositories\InterfaceRepository\ColorInterfaceRepository',
            'App\Repositories\EloquentRepository\ColorRepository'
        );
    }
}
