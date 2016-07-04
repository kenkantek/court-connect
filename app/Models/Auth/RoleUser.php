<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Auth\RoleUser
 *
 * @property integer $role_id
 * @property integer $user_id
 * @property string $context
 * @property boolean $context_id
 */
class RoleUser extends Model
{
    protected $table = 'user_has_roles';

    /**
    * The date fields for the model.clear
    *
    * @var array
    */
    protected $dates    = ['created_at', 'updated_at'];

    protected $fillable = [];
}
