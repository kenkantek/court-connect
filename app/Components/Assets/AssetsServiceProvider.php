<?php
namespace App\Components\Assets;

/**
 * Created by Sublime Text 3.
 * User: Sang Nguyen
 * Date: 22/07/2015
 * Time: 11:26 PM
 */

use Illuminate\Support\ServiceProvider;

/**
 * Class AssetsServiceProvider
 * @package App\Components\Assets
 */
class AssetsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('assets', function () {
            return new Assets();
        });
    }
}
