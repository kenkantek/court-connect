<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $table = 'dates';
    public $timestamps = false;

    public function date_clubs()
    {
        return $this->hasMany('App\Models\DateClub');
    }
}
