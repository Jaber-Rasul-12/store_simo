<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class CategoriesProducts extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    use \Winter\Storm\Database\Traits\Nullable;



    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_categories_products';

    protected $nullable = ['subcategory_id'];

    /**
     * @var array Validation rules
     */
      public $rules = [
        'category_id' => 'required|integer|exists:store_store_categories,id',
        'product_id' => 'required|integer|exists:store_store_products,id',
        'subcategory_id' => 'nullable|integer|exists:store_store_subcategories,id'
    ];

      public $belongsTo = [
          'category' => ['Store\Store\Models\Category'],
          'product' => ['Store\Store\Models\Product'],
          'subcategory' => ['Store\Store\Models\SubCategory']
      ];
      
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];


     public function getSubcategoryIdOptions(){

     if (isset($this->category->id) &&  !empty($this->category->id)) {
        $categoryId = $this->category->id;
      return SubCategory::whereHas( 'category', function($query) use ($categoryId) {
        $query->where('category_id', $categoryId);
      })->get()->lists('name', 'id');
    } else {
      return [];
    }
    }



}
