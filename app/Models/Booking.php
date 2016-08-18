<?php

namespace App\Models;

use App\Models\Auth\User;
use App\Models\Contexts\Court;
use App\Models\Payments\Payment;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $guarded = array();
    protected $appends = ['length'];

    public function court()
    {
        return $this->belongsTo(Court::class,'court_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('y-m-d', strtotime($value));
    }

    public function booked_by()
    {
        return $this->belongsTo(User::class,'booked_by');
    }

    public function getBillingInfoAttribute($value)
    {
        return json_decode($value,true);
    }
    public function getDateRangeOfContractAttribute($value)
    {
        return json_decode($value,true);
    }
    public function getDateAttribute($value)
    {
        return date('m/d/y', strtotime($value));
    }
    public function getCreatedAtAttribute($value)
    {
        return date('m-d-Y h:i:m', strtotime($value));
    }

    public function getLengthAttribute()
    {
        $length = $this->hour+$this->hour_length;
       return $length;
    }

    public function setLengthAttribute()
    {
        $this->attributes['length'] = $this->hour+$this->hour_length;
    }

}
