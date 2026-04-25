<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class SubCategory extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
   


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_subcategories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|string|min:2|max:255|unique:store_store_subcategories,name',
        'description' => 'nullable|string|max:1000',
        'category_id' => 'required|integer|exists:store_store_categories,id'
    ];

      public $belongsTo = [
          'category' => ['Store\Store\Models\Category']
      ];
          public $attachOne = [
        'image' =>[\System\Models\File::class] 
    ];
    public $hasMany = [
      'categories_products' => ['Store\Store\Models\CategoriesProducts']
    ];
    public $jsonable = [];



}
