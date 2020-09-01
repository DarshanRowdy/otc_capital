<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ScriptNewslinks model
  * @property $id
 * @property $script_id
 * @property $script_news_link
 * @property $script_link_header
 */

class ScriptNewslinks extends Model
{
    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_script_newslinks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['script_id', 'script_news_link', 'script_link_header'];

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
