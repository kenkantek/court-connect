<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtRateDetail extends Model
{
    protected $table = 'court_rate_details';
    public $timestamps = false;
    public function date_club()
    {
        return $this->belongsTo('App\Models\DateClub', 'date_club_id');

    }
    public function court()
    {
        return $this->belongsTo('App\Models\Court', 'court_id');

    }
}
