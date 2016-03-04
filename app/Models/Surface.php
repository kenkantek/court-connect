<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surface extends Model
{
    protected $table = 'surface';
    protected $fillable = ['name', 'label'];
}
