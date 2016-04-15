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
    //protected $guarded = array();
    protected $fillable = ['username','email', 'password', 'phone', 'first_name', 'last_name', 'zip_code','city','state','address1','address2','surname', 'facebook', 'google', 'gender', 'fullname'];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }
}
