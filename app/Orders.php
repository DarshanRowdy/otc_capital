<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Orders model
  * @property $order_id
 * @property $order_num
 * @property $script_id
 * @property $order_type
 * @property $order_price
 * @property $order_qty_original
 * @property $lot_size
 * @property $order_date
 * @property $placed_by
 * @property $created_at
 * @property $last_updated_by
 * @property $updated_at
 * @property $cust_id
 * @property $assigned_to
 * @property $notes
 */

class Orders extends Model
{
    protected $guarded = ['order_id', 'order_num'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_orders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['script_id', 'order_type', 'order_price', 'order_qty_original', 'lot_size', 'order_date', 'placed_by', 'creation_date', 'last_updated_by', 'last_update_date', 'cust_id', 'assigned_to', 'notes'];

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
    protected $dates = ['order_date', 'created_at', 'updated_at'];

    public static function findByField($field, $value)
    {
        return self::where($field, (string)$value)->first();
    }
}
