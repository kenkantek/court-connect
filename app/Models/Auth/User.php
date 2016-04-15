<?php

namespace App\Models\Auth;

use App\Models\Contexts\Club;
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
    public function roles()
    {
        return $this->belongsToMany(
            config('laravel-permission.models.role'),
            config('laravel-permission.table_names.user_has_roles')
        )->withPivot('context', 'context_id');
    }
    public function clubs()
    {
        if ($this->is_super) {
            return Club::with('state_info','city_info')->orderBy('id', 'ASC');
        } else {
            $roles = $this->roles()->where('context', 'clubs')->lists('context_id');
            return Club::whereIn('id', $roles)->with('state_info','city_info')->orderBy('id', 'ASC');
        }

    }
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
    public function assignRole($role, $context = NULL, $context_id = NULL)
    {
        $pivot = array();
        if($pivot != NULL)
            $priot['context'] = $context;
        if($context_id != NULL)
            $pivot['context_id'] = $context_id;
        $this->roles()->attach($this->getStoredRole($role), $pivot);
    }
    public function isSuper()
    {
        return $this->is_super;
    }
    public function getContextID(){
        $arr = array();
        foreach ($this->roles as $role)
        {
            $arr[] = $role->pivot->context_id;
        }
        return $arr[0];
    }
    public function scopeInfoClub(){
        $arr = array();
        foreach ($this->roles as $k=>$role)
        {
            $arr[$k]['content'] = $role->pivot->context;
            $arr[$k]['content_id'] = $role->pivot->context_id;
        }
        return $arr[0];
    }

}
