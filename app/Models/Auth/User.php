<?php

namespace App\Models\Auth;

use App\Models\Contexts\Club;
use App\Models\Player;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use HasRoles;
    use SearchableTrait;

    protected $table = 'users';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at','trial_ends_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'phone', 'first_name', 'last_name', 'zip_code','address1','address2 ','state','city','facebook', 'google', 'gender'];
    protected $appends = ['fullname'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $searchable = [
        'columns' => [
            'first_name' => 20,
            'last_name' => 10,
            'email' => 20,
        ]
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
            return Club::with('state_info','city_info')->orderBy('created_at','desc');
        } else {
            $roles = $this->roles()->where('context', 'clubs')->lists('context_id');
            return Club::whereIn('id', $roles)->with('state_info','city_info')->orderBy('created_at','desc');
        }

    }
    /**
     * Always capitalize the first name when we retrieve it
     */

    public function teacher()
    {
        return $this->hasOne('App\Models\Teacher');
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFullnameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
    public function getPlayer()
    {
        $player = Player::where('user_id',$this->id)->first();
        if(isset($player)) {
            return $player;
        }
        return null;
    }

    public function assignRole($role, $context = null, $context_id = null)
    {
        $pivot = array();
        if($context != null)
            $pivot['context'] = $context;
        if($context_id != null)
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

    public function scopeIsPlayer()
    {
        return $this->roles()->wherePivot('context', 'players');
    }
}
