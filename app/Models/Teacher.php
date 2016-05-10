<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
class Teacher extends Model
{
    protected $table = 'teacher';
    protected $guarded = array();


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}