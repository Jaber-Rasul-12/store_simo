<?php namespace Store\Store\Classes;
use Session;
use Store\Store\Models\Price;
use Store\Store\Models\Product;
use Winter\User\Facades\Auth;
use Flash;
class CartManager
{


    public $userId;
    public function __construct()
    {
        $this->userId = Auth::getUser()->id;
    }




    public  function addToSessionCart($productId, $quantity = 1)
    {
        $userId = Auth::getUser()->id;
        $cart = Session::get("cart-$userId", []);

        $product = Product::with(['prices'=>function($query){
            $query->where('status', true);
        }])->where('id', $productId)->get()->first();

        $price = $product->prices->first()->price ?? 0;
        $taxes_products = $product->taxes_products()->where('status', true)->get()->sum('price') ?? 0;

        $cart[$productId] = [
            'id' => $productId, 
            'quantity' => $quantity, 
            'name' => $product->name, 
            'price_main' => $price,
            'price_after_taxes' => $price + $taxes_products,
            'taxes' => $taxes_products, 
            'image_path' => $product->image ? $product->image->getPath() : null
        ];
     
        
        Session::put("cart-$userId", $cart);
    }
    
    public  function getCartItems()
    {
        $userId = Auth::getUser()->id;
        return Session::get("cart-$userId", []);
    }

    public  function getCartCount()
    {
        $userId = Auth::getUser()->id;
        return count(Session::get("cart-$userId", [])) ?? 0;
    }

     public  function removeFromSessionCart()
    {
        $userId = Auth::getUser()->id;
        $cart = Session::forget("cart-$userId");
    }

}