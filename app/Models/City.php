<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'citys_new';

    public function state()
    {
        return $this->belongsTo('App\Models\State','state_code');
    }
    public function clubs()
    {
        return $this->hasMany('App\Models\Club');
    }
}
