<?php

namespace App\Models\Contexts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contexts\Club
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $location_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Club extends Model
{
    protected $table = 'clubs';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = [];
}
