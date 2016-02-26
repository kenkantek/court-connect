<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payments\PaymentType
 *
 * @property integer $id
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class PaymentType extends Model
{
    protected $table = 'payment_types';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = [];
}
