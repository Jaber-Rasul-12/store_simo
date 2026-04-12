<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Color extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
   



    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_colors';

    /**
     * @var array Validation rules
     */
      public $rules = [
        'name' => 'required|unique:store_store_colors,name|max:255',
        'code' => 'required|unique:store_store_colors,code|max:255'
    ];

    public $belongsToMany = [
        'products' => ['Store\Store\Models\Product', 'table' => 'store_store_products_colors'],
    ];

    

}
