<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payments\Payment
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $zip_code
 * @property integer $payment_type
 * @property string $card_number
 * @property boolean $expiration_month
 * @property boolean $expiration_year
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Payment extends Model
{
    protected $table = 'payments';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];
    protected $guarded = array();
}
