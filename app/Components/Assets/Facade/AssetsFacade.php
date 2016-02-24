<?php
namespace App\Components\Assets\Facade;

/**
 * Created by Sublime Text 3.
 * User: Sang Nguyen
 * Date: 22/07/2015
 * Time: 11:25 PM
 */

use Illuminate\Support\Facades\Facade;

/**
 * Class AssetsFacade
 * @package App\Components\Assets\Facade
 */
class AssetsFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'assets';
    }
}
