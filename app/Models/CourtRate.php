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
}
