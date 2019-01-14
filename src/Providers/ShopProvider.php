<?php

namespace Grundmanis\Laracms\Modules\Shop\Providers;

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
            'admin.menu.customers' => 'laracms.customers',
            'admin.menu.shops' => 'laracms.shops',
            'admin.menu.orders' => 'laracms.orders',
            'admin.menu.reviews' => 'laracms.reviews',
            'admin.menu.categories' => 'laracms.categories',
            'admin.menu.shop-fields' => 'laracms.fields'
        ];

        MenuFacade::addMenu($menu);
    }

}
