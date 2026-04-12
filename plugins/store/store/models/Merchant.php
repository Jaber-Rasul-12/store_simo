<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Merchant extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    



    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_merchants';

    /**
     * @var array Validation rules
     */
    /**
     * @var array Validation rules
     */
    public $rules = [
        'full_name' => 'required|string|max:255',
        'address'   => 'required|string|max:500',
        'phone'     => 'required|string|max:20|regex:/^[\+\d\s\-\(\)]+$/',
    ];


        public $hasMany = [
        'products' => 'Store\Store\Models\Product',

    ];


   
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];



}
