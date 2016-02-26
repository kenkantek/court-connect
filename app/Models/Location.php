<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Location
 *
 * @property integer $id
 * @property string $city
 * @property string $state_code
 * @property string $state
 * @property string $zipcode
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Location extends Model
{
    protected $table = 'locations';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = [];
}
