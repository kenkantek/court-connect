<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Auth\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Role extends \Spatie\Permission\Models\Role
{
    protected $table = 'roles';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $fillable = ['name', 'label'];
    public $timestamp = false;

}
