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
class Club extends Model
{
    protected $table = 'clubs';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'phone', 'image', 'address', 'country', 'longitude', 'latitude', 'city', 'state', 'zipcode'];

    public function courts()
    {
        return $this->hasMany('App\Models\Court');
    }
    public function date_clubs()
    {
        return $this->hasMany('App\Models\DateClub');
    }
    public function deal()
    {
        return $this->hasMany('App\Models\Deal');
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city');
    }
}
