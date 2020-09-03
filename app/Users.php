<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Users model
 * @property $user_id
 * @property $user_name
 * @property $password
 * @property $user_mobile
 * @property $user_email
 * @property $auth_token
 * @property $password_reset_token
 * @property $user_status
 * @property $created_at
 * @property $created_by
 * @property $updated_at
 * @property $last_updated_by
 * @property $user_attribute_1
 * @property $user_attribute_2
 * @property $user_attribute_3
 * @property $user_attribute_4
 * @property $user_attribute_5
 * @property $user_attribute_6
 * @property $user_attribute_7
 * @property $user_attribute_8
 * @property $user_attribute_9
 * @property $user_attribute_10
 * @property $user_attribute_11
 */

class Users extends Authenticatable
{
    protected $guarded = ['user_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_name', 'password', 'user_mobile', 'user_email', 'auth_token', 'password_reset_token', 'user_status', 'creation_date', 'created_by', 'last_update_date', 'last_updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'user_attribute_1', 'user_attribute_2', 'user_attribute_3', 'user_attribute_4', 'user_attribute_5', 'user_attribute_6', 'user_attribute_7', 'user_attribute_8', 'user_attribute_9', 'user_attribute_10', 'user_attribute_11'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public static function findByField($field, $value)
    {
        return self::where($field, (string)$value)->first();
    }
}
