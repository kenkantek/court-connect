<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => 'App\Http\Controllers\Home'], function ($router) {
            require app_path('Http/Composers/Home/assets.php');
            require app_path('Http/Endpoints/Home/routes.php');
        });

        $router->group(['namespace' => 'App\Http\Controllers\Admin'], function ($router) {
            require app_path('Http/Composers/Admin/assets.php');
            require app_path('Http/Endpoints/Admin/routes.php');
        });

        $router->group(['namespace' => 'App\Http\Controllers\Auth'], function ($router) {
            require app_path('Http/Composers/Auth/assets.php');
            require app_path('Http/Endpoints/Auth/routes.php');
        });
    }
}
