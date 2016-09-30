<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Deal
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $player_id
 * @property integer $court_id
 * @property float $price
 * @property string $time
 * @property integer $payment_id
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Contract extends Model
{
    protected $table = 'contracts_club';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = ['club_id', 'start_date', 'end_date', 'note','total_week','rates_member', 'rates_nonmember','extras','is_member'];

    public function club()
    {
        return $this->belongsTo('App\Models\Club');
    }
     public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date('y-m-d', strtotime($value));
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = date('y-m-d', strtotime($value));
    }
    public function getStartDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }
    public function getEndDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }

    public function getRatesMemberAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setRatesMemberAttribute($value)
    {
         $this->attributes['rates_member'] =  json_encode($value);
    }

    public function getRatesNonmemberAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setRatesNonmemberAttribute($value)
    {
        $this->attributes['rates_nonmember'] =  json_encode($value);
    }

    public function getExtrasAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setExtrasAttribute($value)
    {
         $this->attributes['extras'] =  json_encode($value);
    }
}
