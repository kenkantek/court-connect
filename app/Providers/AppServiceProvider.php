<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //return auth()->user()->roles()->get();
        view()->composer('admin.layouts.master', function ($view) {
            if (auth()->check()) {
                $view->with('userLogin', auth()->user());
            }

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if (config('app.env') == 'local') {
//            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
//            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//        }
    }
}
