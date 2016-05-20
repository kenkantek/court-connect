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
class Deal extends Model
{
    protected $table = 'deals';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $guarded = array();

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('y-m-d', strtotime($value));
    }
    public function getDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }
    public function getPriceMemberAttribute($value)
    {
        return floatval($value);
    }
    public function getPriceNonmemberAttribute($value)
    {
        return floatval($value);
    }
}
