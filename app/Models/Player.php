<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Player
 *
 */
class Player extends Model
{
    protected $table = 'players';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = ['user_id', 'receive_discount_offers', 'tenis_level', 'is_recive_notification', 'zipcode', 'address1', 'address2', 'city', 'state'];



    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }
}
