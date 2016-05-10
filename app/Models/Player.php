<?php

namespace App\Models;

use App\Models\Payments\Payment;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\Player
 *
 */
class Player extends Model
{
    protected $table = 'players';
    protected $guarded = array();
    //protected $fillable = ['username','email', 'password', 'phone', 'first_name', 'last_name', 'zip_code','city','state','address1','address2','surname', 'facebook', 'google', 'gender', 'fullname'];
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
