<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetOpenDay extends Model
{
    protected $table = 'set_open_days';
    public $timestamps = false;
    public function club()
    {
        return $this->belongsTo('App\Models\Contexts\Club', 'club_id');

    }
}
