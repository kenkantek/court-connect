<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeUnavailable extends Model
{
    protected $table = 'time_unavailables';
    protected $guarded = array();

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('y-m-d', strtotime($value));
    }
    public function getDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }
}
