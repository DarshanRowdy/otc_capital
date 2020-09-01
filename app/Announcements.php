<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * announcements model
 * @property $id
 * @property $announcement_list
 * @property $pinned
 */

class Announcements extends Model
{
    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_announcements';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['announcement_list', 'pinned'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

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
    protected $dates = [];

    public static function findByField($field, $value)
    {
        return self::where($field, (string)$value)->first();
    }
}
