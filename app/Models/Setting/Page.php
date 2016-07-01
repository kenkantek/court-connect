<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    protected $guarded = array();
    protected $fillable = ['title','description','thumb'];
}
