<?php

namespace App\Models\Contexts;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contexts\Group
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Group extends Model
{
    protected $table = 'groups';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = [];
}
