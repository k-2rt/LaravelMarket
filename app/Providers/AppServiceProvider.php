<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                \App\Repositories\Order\OrderRepositoryInterface::class,
                \App\Repositories\Order\OrderRepository::class
        );
        $this->app->bind(
                \App\Repositories\Shipping\ShippingRepositoryInterface::class,
                \App\Repositories\Shipping\ShippingRepository::class
        );
        $this->app->bind(
                \App\Repositories\OrderDetail\OrderDetailRepositoryInterface::class,
                \App\Repositories\OrderDetail\OrderDetailRepository::class
        );
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
