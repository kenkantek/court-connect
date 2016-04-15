<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateClub extends Model
{
    protected $table = 'date_club';
    public $timestamps = false;
//    public function date()
//    {
//        return $this->belongsTo('App\Models\Date', 'date_id');
//    }
    public function club()
    {
        return $this->belongsTo('App\Models\Contexts\Club','club_id');
    }
//    public function court_rate_details()
//    {
//        return $this->hasMany('App\Models\CourtRateDetail');
//    }
}
