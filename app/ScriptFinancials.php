<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ScriptFinancials model
  * @property $id
 * @property $script_id
 * @property $fin_year
 * @property $script_revenue
 * @property $script_profit
 * @property $script_eps
 * @property $script_book_value
 * @property $script_promoter_holding
 * @property $script_issued
 * @property $created_at
 * @property $created_by
 * @property $updated_at
 * @property $last_updated_by
 */

class ScriptFinancials extends Model
{
    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_script_financials';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['script_id', 'fin_year', 'script_revenue', 'script_profit', 'script_eps', 'script_book_value', 'script_promoter_holding', 'script_issued', 'creation_date', 'created_by', 'last_update_date', 'last_updated_by'];

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
    protected $dates = ['created_at', 'updated_at'];

    public static function findByField($field, $value)
    {
        return self::where($field, (string)$value)->first();
    }
}
