<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Brand extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
   



    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_brands';

    /**
     * @var array Validation rules
     */
  
     public $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|alpha_dash|max:255|unique:store_store_brands,slug',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'is_top' => 'boolean',
        'is_popular' => 'boolean',
        'is_trending' => 'boolean',
        'description' => 'nullable|string',
    ];

    public $hasMany = [
        'products' => ['Store\Store\Models\Product', 'key' => 'brand_id']
    ];

    public $belongsToMany = [
    'related_brands' => [
        self::class,
        'table' => 'store_store_brand_related',
        'key' => 'brand_id',
        'otherKey' => 'related_brand_id'
    ]
];
    

    public $attachOne = [
        'image' =>[\System\Models\File::class] 
    ];


    public function afterSave()
{
    foreach ($this->related_brands as $brand) {
        $brand->related_brands()->syncWithoutDetaching([$this->id]);
    }
}

}
