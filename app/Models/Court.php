<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Court
 *
 * @property integer $id
 * @property integer $club_id
 * @property string $opening_time
 * @property string $closing_time
 * @property string $opening_day
 * @property float $member_price
 * @property float $non_member_price
 * @property boolean $indoor_outdoor
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Court extends Model
{
    protected $table = 'courts';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = [];
}
