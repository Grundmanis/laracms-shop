<?php

namespace Grundmanis\Laracms\Modules\Shop\Providers;

use Grundmanis\Laracms\Modules\Pages\Exception\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Grundmanis\Laracms\Facades\MenuFacade;

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
            __DIR__.'/../views/partials/' => resource_path('views/partials/shop'),
        ], 'laracms_pages');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->addMenuRoutes();
    }

    /**
     *
     */
    private function addMenuRoutes()
    {
        $menu = [
            'Sellers' => 'laracms.sellers',
            'Buyers' => 'laracms.buyers',
            'Shops' => 'laracms.shops',
            'Orders' => 'laracms.orders',
            'Reviews' => 'laracms.reviews',
            'Categories' => 'laracms.categories',
            'Shop Fields' => 'laracms.fields'
        ];

        MenuFacade::addMenu($menu);
    }

}
