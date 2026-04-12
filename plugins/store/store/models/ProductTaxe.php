<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class ProductTaxe extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
   


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_product_taxes';

    /**
     * @var array Validation rules
     */
  public $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'status' => 'boolean',
    ];



     public $belongsToMany = [
        'products' => ['Store\Store\Models\Product', 'table' => 'store_store_product_taxes_products'],
    ];
  


}
