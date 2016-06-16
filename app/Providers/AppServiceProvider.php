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
    \Braintree\Configuration::environment(getenv('BT_ENVIRONMENT'));
    \Braintree\Configuration::merchantId(getenv('BT_MERCHANT_ID'));
    \Braintree\Configuration::publicKey(getenv('BT_PUBLIC_KEY'));
    \Braintree\Configuration::privateKey(getenv('BT_PRIVATE_KEY'));

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
