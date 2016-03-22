<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtRate extends Model
{
    protected $table = 'court_rate';
    public function court()
    {
        return $this->belongsTo('App\Models\Contexts\Court', 'court_id');

    }
    public function getRatesAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date('y-m-d', strtotime($value));
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = date('y-m-d', strtotime($value));
    }
    public function getStartDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }
    public function getEndDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }
}
