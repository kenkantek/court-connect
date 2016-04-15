<?php

namespace App\Providers\Admin;

use App\Repositories\Eloquent\Admin\ClubRepository;
use App\Repositories\Eloquent\Admin\ContractRepository;
use App\Repositories\Eloquent\Admin\CourtRepository;
use App\Repositories\Interfaces\Admin\ClubInterface;
use App\Repositories\Interfaces\Admin\ContractInterface;
use App\Repositories\Interfaces\Admin\CourtInterface;
use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClubInterface::class, CLubRepository::class);
        $this->app->bind(CourtInterface::class, CourtRepository::class);
        $this->app->bind(ContractInterface::class, ContractRepository::class);

    }
}
