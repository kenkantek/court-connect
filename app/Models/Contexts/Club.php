<?php

namespace App\Models\Contexts;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
/**
 * App\Models\Contexts\Club
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $location_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Club extends Model
{
    use SearchableTrait;
    protected $table = 'clubs';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'phone', 'address', 'city', 'state', 'zipcode'];
    protected $searchable = [
        'columns' => [
            'clubs.name' => 20,
            'clubs.state' => 10,
            'clubs.address' => 20,
            'clubs.zipcode' => 6,
            'clubs.city' => 10
        ]
    ];

    public function courts()
    {
        return $this->hasMany('App\Models\Contexts\Court');
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city');
    }
    public function state_info()
    {
        return $this->belongsTo('App\Models\State', 'state');
    }
    public function city_info()
    {
        return $this->belongsTo('App\Models\City', 'city');
    }
    public function date_clubs()
    {
        return $this->hasMany('App\Models\DateClub');
    }
}
