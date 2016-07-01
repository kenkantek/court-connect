<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $guarded = array();
    protected $fillable = ['question', 'answer'];
}
