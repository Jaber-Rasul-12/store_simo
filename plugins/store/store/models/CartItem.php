<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class CartItem extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
 


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_cart_items';

    /**
     * @var array Validation rules
     */

    public $fillable = ['product_id', 'promotion_id', 'user_id', 'qty', 'price', 'cart_id'];
       /**
     * @var array Validation rules
     */
    public $rules = [
        'product_id' => 'required|exists:store_store_products,id',
        'promotion_id' => 'nullable|exists:store_store_promotions,id',
        'user_id' => 'required|exists:users,id',
        'qty' => 'required|integer|min:1|max:1000',
        'price' => 'required|numeric|min:0',
        'cart_id' => 'required|exists:store_store_carts,id',
    ];




    /**
     * Relationships
     */
    public $belongsTo = [
        'product' => [Product::class, 'key' => 'product_id'],
        'promotion' => [Promotion::class, 'key' => 'promotion_id'],
        'user' => [\Winter\User\Models\User::class, 'key' => 'user_id'],
        'cart' => [Cart::class, 'key' => 'cart_id'], 
    ];




}
