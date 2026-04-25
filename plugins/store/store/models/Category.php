<?php namespace Store\Store\Models;

use Model;

class Category extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_categories';

    /**
     * @var array Validation rules
     */

  public $rules = [
        'name' => 'required|string|min:2|max:255',
        'slug' => 'required|alpha_dash|unique:store_store_categories,slug|min:2|max:255',
        'status' => 'boolean',
        'show_homepage' => 'boolean',
        'is_featured' => 'boolean',
        'is_top' => 'boolean',
        'is_popular' => 'boolean',
        'is_trending' => 'boolean',
        'description' => 'nullable|string|max:1000',
        'color' => 'required|string|max:50'
    ];

    public $belongsToMany = [
                'products' => ['Store\Store\Models\Product', 'table' => 'store_store_categories_products'],
         'related_categories' => [
        self::class,
        'table' => 'store_store_category_related',
        'key' => 'category_id',
        'otherKey' => 'related_category_id'
    ]
    ];

    public $hasMany = [
        'subcategories' => ['Store\Store\Models\SubCategory'],
        'categories_products' => ['Store\Store\Models\CategoriesProducts']
    ];



 

  


}
