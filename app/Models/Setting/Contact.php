<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $guarded = array();
    protected $fillable = ['name', 'email','phone','messages'];
}
