<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class State extends Model
{
    protected $table = 'states';
    public function clubs()
    {
        return $this->hasMany('App\Models\Club');
    }
    public function citys()
    {
        return $this->hasMany('App\Models\City');
    }

}
