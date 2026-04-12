<?php

namespace Store\Store\Models;

use Model;
use Wallet\Wallet\Models\Wallet;
use Winter\User\Models\User;

// use Winter\Storm\Database\Builder;
// use BackendAuth;

/**
 * Model
 */
class Cart extends Model
{
    use \Winter\Storm\Database\Traits\Validation;




    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_carts';



    public $fillable = ['user_id', 'wallet_id', 'coupon_id', 'total_price', 'total_promotions', 'final_price' , 'type', 'notes', 'contacts', 'status' , 'location_lat', 'location_lng', 'address'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'user_id' => 'required|exists:users,id',
        'wallet_id' => '',
        'notes' => 'nullable|string|max:1000',
        'contacts' => 'nullable|string|max:500',
        'location_lat' => 'nullable|string|max:1000',
        'location_lng' => 'nullable|string|max:1000',
        'address' => 'nullable|string|max:1000',
        'status' => 'required|boolean',
        'type' => 'required|in:cashe,wallet',
        'coupon_id'=>'nullable|exists:store_store_coupons,id',
        'total_price' => 'required|numeric|min:0',
        'total_promotions' => 'required|numeric|min:0',
        'final_price' => 'required|numeric|min:0',
    ];



    /**
     * Relationships
     */
    public $belongsTo = [
        'user' => [User::class, 'key' => 'user_id'],
        'wallet' => [\Wallet\Wallet\Models\Wallet::class, 'key' => 'wallet_id'],
        'coupon'=>[Coupon::class,'key'=>'coupon_id'],

    ];

    public $hasMany = [
        'items' => [CartItem::class, 'key' => 'cart_id']
    ];


    public function getWalletIdOptions()
    {
        if (isset($this->user) && !is_null($this->user->id)) {
            return Wallet::where('user_id', $this->user->id)->lists('public_id', 'id');
        } else {
            return [];
        }
    }




    public function beforeValidate()
    {
        if ($this->type == 'cashe') {
            $this->rules['wallet_id'] = 'nullable|exists:wallet_wallet_wallets,id';
            $this->wallet_id = null;
        } else {
            $this->rules['wallet_id'] = 'required|exists:wallet_wallet_wallets,id';
        }
    }





    /**
     * After delete event - delete all cart items
     */
    public function afterDelete()
    {
        $this->items()->delete();
    }

    /**
     * Scope for active carts
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for abandoned carts
     */
    public function scopeAbandoned($query)
    {
        return $query->where('status', 'abandoned');
    }

    /**
     * Scope for converted carts (completed orders)
     */
    public function scopeConverted($query)
    {
        return $query->where('status', 'converted');
    }

    /**
     * Scope by user ID
     */
    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope by cart type
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get cart by user ID
     */
    public static function getActiveByUserId($userId)
    {
        return static::user($userId)->active()->first();
    }

    /**
     * Calculate total amount of cart items
     */
    public function getTotalAmountAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    /**
     * Calculate total quantity of items in cart
     */
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }

    /**
     * Check if cart is empty
     */
    public function getIsEmptyAttribute()
    {
        return $this->items->isEmpty();
    }

    /**
     * Check if cart can use wallet payment
     */
    public function getCanUseWalletAttribute()
    {
        return !is_null($this->wallet_id) && $this->wallet->status;
    }

    /**
     * Mark cart as converted (order completed)
     */
    public function markAsConverted()
    {
        $this->status = 'converted';
        return $this->save();
    }

    /**
     * Mark cart as abandoned
     */
    public function markAsAbandoned()
    {
        $this->status = 'abandoned';
        return $this->save();
    }

    /**
     * Add product to cart
     */
    public function addProduct($productId, $quantity = 1)
    {
        $cartItem = $this->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            return $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'cart_id' => $this->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
            return $cartItem->save();
        }
    }

    /**
     * Remove product from cart
     */
    public function removeProduct($productId)
    {
        return $this->items()->where('product_id', $productId)->delete();
    }

    /**
     * Clear all items from cart
     */
    public function clearItems()
    {
        return $this->items()->delete();
    }
}
