<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\InterfaceRepository\ProductDetailInterfaceRepository;
use App\Repositories\EloquentRepository\ProductDetailRepository;
use App\Repositories\InterfaceRepository\UserInterfaceRepository;
use App\Repositories\EloquentRepository\UserRepository;
use App\Repositories\InterfaceRepository\CategoryInterfaceRepository;
use App\Repositories\EloquentRepository\CategoryRepository
use App\Repositories\InterfaceRepository\SizeInterfaceRepository;
use App\Repositories\EloquentRepository\SizeRepository;
use App\Repositories\InterfaceRepository\ColorInterfaceRepository;
use App\Repositories\EloquentRepository\ColorRepository;
use App\Repositories\InterfaceRepository\ProductInterfaceRepository;
use App\Repositories\EloquentRepository\ProductRepository;


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
        $this->app->bind(UserInterfaceRepository::class, UserRepository::class);
        $this->app->bind(CategoryInterfaceRepository::class, CategoryRepository::class);
        $this->app->bind(SizeInterfaceRepository::class, SizeRepository::class);
        $this->app->bind(ColorInterfaceRepository::class, ColorRepository::class);
        $this->app->bind(ProductInterfaceRepository::class, ProductRepository::class);
        $this->app->bind(ProductDetailInterfaceRepository::class, ProductDetailRepository::class);
    }
}
