<?php
namespace App\Providers\Auth;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\Auth\UserInterface;
use App\Repositories\Eloquent\Auth\UserRepository;

class UserProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
    }
}
