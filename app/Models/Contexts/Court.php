<?php

namespace App\Models\Contexts;

use App\Models\Surface;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
/**
 * App\Models\Court
 *
 * @property integer $id
 * @property integer $club_id
 * @property string $opening_time
 * @property string $closing_time
 * @property string $opening_day
 * @property float $member_price
 * @property float $non_member_price
 * @property boolean $indoor_outdoor
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Court extends Model
{
    use SearchableTrait;

    protected $table = 'courts';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'indoor_outdoor', 'club_id', 'surface_id'];

    protected $searchable = [
        'columns' => [
            'name' => 10,
            'surface_id' => 10,
            'indoor_outdoor'=> 10,
        ]
    ];
    public function club()
    {
        return $this->belongsTo('App\Models\Contexts\Club','club_id');
    }
    public function surface()
    {
        return $this->belongsTo(Surface::class);
    }
    public function rates()
    {
        return $this->hasMany('App\Models\CourtRate', 'court_id');
    }
    public function court_rate_details()
    {
        return $this->hasMany('App\Models\CourtRateDetail');
    }
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
