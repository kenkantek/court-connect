<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Deal
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $player_id
 * @property integer $court_id
 * @property float $price
 * @property string $time
 * @property integer $payment_id
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

    protected $fillable = ['club_id', 'indoor_outdoor', 'status', 'surface_id', 'name'];

    public function club()
    {
        return $this->belongsTo('App\Models\Club');
    }
    public function deal()
    {
        return $this->hasMany('App\Models\Deal');
    }
}