<?php

namespace App\Models\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\Auth\User
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property string $zip_code
 * @property string $facebook
 * @property string $google
 * @property boolean $gender
 * @property string $avatar
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasRoles;

    protected $table = 'users';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'phone', 'first_name', 'last_name', 'zip_code', 'facebook', 'google', 'gender', 'fullname'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Always capitalize the first name when we retrieve it
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Always capitalize the last name when we retrieve it
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFullName()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
    public function assignRole($role, $context, $context_id)
    {
        $this->roles()->attach($this->getStoredRole($role), array(
            'context' => $context,
            'context_id' => $context_id,
        ));
    }
}
