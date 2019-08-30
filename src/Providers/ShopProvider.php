<?php

namespace Grundmanis\Laracms\Modules\Shop\Providers;

use Illuminate\Support\ServiceProvider;

class ShopProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'laracms.shop');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadRoutesFrom(__DIR__ . '/../laracms_shop_routes.php');

        $this->publishes([
            __DIR__.'/../views/partials/' => resource_path('views/laracms/shop/partials'),
        ], 'laracms');
    }
}
