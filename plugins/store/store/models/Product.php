<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
use BackendAuth;

use function PHPUnit\Framework\isNull;

/**
 * Model
 */
class Product extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    use \Winter\Storm\Database\Traits\Purgeable; 
 


    protected $purgeable = ['price'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_products';

    /**
     * @var array Validation rules
     */
   
    public $rules = [
        'name' => 'required|string|max:255',
        'short_name' => 'required|string|max:100',
        'slug' => 'required|string|unique:store_store_products,slug',
        'backend_user_id' => 'required|exists:backend_users,id',
        'merchant_id' => 'required|exists:store_store_merchants,id',

        'brand_id' => 'required|exists:store_store_brands,id',
        'short_description' => 'required|string|max:500',
        'long_description' => 'required|string',
        'video_link' => 'nullable|url|max:500',
        'qty' => 'required|numeric',
        'is_featured' => 'boolean',
        'new_product' => 'boolean',
        'is_top' => 'boolean',
        'is_best' => 'boolean',
        'status' => 'required|boolean',
    ];


        /**
     * Relationships
     */
    public $belongsTo = [
        'backend_user' => [\Backend\Models\User::class, 'key' => 'backend_user_id'],
        'brand' => [Brand::class, 'key' => 'brand_id'],
        'merchant' => [Merchant::class, 'key' => 'merchant_id']

    ];
    public $belongsToMany = [
        'categories' => ['Store\Store\Models\Category', 'table' => 'store_store_categories_products'],
        'taxes_products' => ['Store\Store\Models\ProductTaxe', 'table' => 'store_store_product_taxes_products'],
        'return_policies' => ['Store\Store\Models\ReturnPolicy', 'table' => 'store_store_products_return_policies'],
        'colors' => ['Store\Store\Models\Color', 'table' => 'store_store_products_colors'],
        'sizes' => ['Store\Store\Models\Size', 'table' => 'store_store_products_sizes'],
        'related_products' => [
        self::class,
        'table' => 'store_store_product_related',
        'key' => 'product_id',
        'otherKey' => 'related_product_id'
    ]
        ];



    public $hasMany = [
        'prices' => 'Store\Store\Models\Price',
        'promotions' => ['Store\Store\Models\Promotion', 'key' => 'product_id'],
        'comments' => ['Store\Store\Models\Comment', 'key' => 'product_id'],

    ];

    public $attachOne = [
        'image' =>[\System\Models\File::class] 
    ];


    public $attachMany = [
        'images' => [\System\Models\File::class]
    ];


        public function getAverageRatingAttribute()
    {
        if (!$this->exists) {
            return 0;
        }
        
        $average = $this->comments()->avg('rating');
        return $average ? round($average, 1) : 0;
    }

         public function getPromotionsActiveAttribute()
        {
        
            $promotions = $this->promotions()->where('status', true)->first();
            return $promotions;
        }

           public function getHasPromotionsAttribute()
        {
            return $this->promotions()->where('status', true)->exists() ? true : false;
        }

        public function getStarRatingAttribute()
    {
        $rating = $this->averageRating;
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;
        
        return [
            'full' => $fullStars,
            'half' => $halfStar ? 1 : 0,
            'empty' => 5 - $fullStars - ($halfStar ? 1 : 0),
            'percentage' => ($rating / 5) * 100
        ];
    }


  public function beforeValidate()
    {
        // Auto assign the backend user who is logged in
        if (!$this->backend_user_id) {
            $this->backend_user_id = BackendAuth::getUser()->id;
        }

        // Fix: Properly check for empty or null qty
        if (empty($this->qty) || $this->qty === null) {
            $this->qty = 0;
        }
    } 

    public function beforeCreate()
    {
        if(empty($this->getOriginalPurgeValue('price'))){
            throw new \ValidationException(['price' => trans('store.store::lang.plugin.price_require')]);;
        }
    }

    public function afterCreate()
    {
        $this->prices()->create([
            'price' => $this->getOriginalPurgeValue('price'),
            'status' => 1
        ]);
    }

}
