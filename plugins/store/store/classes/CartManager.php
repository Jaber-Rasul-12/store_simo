<?php namespace Store\Store\Classes;
use Session;
use Store\Store\Models\Price;
use Store\Store\Models\Product;
use Winter\User\Facades\Auth;
use Flash;
use Store\Store\Models\Color;
use Store\Store\Models\Size;

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
            'quantity' => 0, 
            'name' => $product->name, 
            'price_main' => $price,
            'price_after_taxes' => $price + $taxes_products,
            'taxes' => $taxes_products, 
            'image_path' => $product->image ? $product->image->getPath() : null
        ];
     
        
        Session::put("cart-$userId", $cart);
    }


public function addQuantityToProduct($productId, $quantity = 1, $sizeId = null, $colorId = null)
{
    $color = $colorId ? Color::find($colorId) : null;
    $size = $sizeId ? Size::find($sizeId) : null;
    $userId = Auth::getUser()->id;
    $cart = Session::get("cart-$userId", []);
    
    if (isset($cart[$productId])) {
        // ✅ التأكد من أن quantity هو مصفوفة
        if (!isset($cart[$productId]['quantity']) || !is_array($cart[$productId]['quantity'])) {
            $cart[$productId]['quantity'] = [];
        }
        
        // البحث إذا كان نفس اللون والقياس موجودين
        $found = false;
        foreach ($cart[$productId]['quantity'] as &$item) {
            if ($item['size_id'] == $sizeId && $item['color_id'] == $colorId) {
               $item['quantity'] = $quantity;
                $found = true;
                break;
            }
        }
        unset($item);
        
        if (!$found) {
            // إضافة خيار جديد
            $cart[$productId]['quantity'][] = [
                'quantity' => $quantity,
                'size_id' => $sizeId,
                'color_name' => $color ? $color->name : null,
                'size_name' => $size ? $size->name : null,
                'color_id' => $colorId
            ];
        }
    } else {
        // منتج جديد
        $cart[$productId] = [
            'quantity' => [
                [
                    'quantity' => $quantity,
                    'size_id' => $sizeId,
                    'color_id' => $colorId,
                    'color_name' => $color ? $color->name : null,
                    'size_name' => $size ? $size->name : null,
                ]
            ]
        ];
    }
    
    Session::put("cart-$userId", $cart);
    return true;
}

public function removeQuantityFromProduct($productId, $sizeId = null, $colorId = null)
{
    $userId = Auth::getUser()->id;
    $cart = Session::get("cart-$userId", []);
    
    // التحقق من وجود المنتج في السلة
    if (!isset($cart[$productId])) {
        return false;
    }
    
    // التحقق من وجود الكميات
    if (!isset($cart[$productId]['quantity']) || !is_array($cart[$productId]['quantity'])) {
        return false;
    }
    
    // البحث عن الخيار المطلوب حذفه
    $foundIndex = null;
    foreach ($cart[$productId]['quantity'] as $index => $item) {
        if ($item['size_id'] == $sizeId && $item['color_id'] == $colorId) {
            $foundIndex = $index;
            break;
        }
    }
    
    // إذا تم العثور على الخيار
    if ($foundIndex !== null) {
        // حذف الخيار من المصفوفة
        array_splice($cart[$productId]['quantity'], $foundIndex, 1);
        
        // إذا أصبحت مصفوفة الكميات فارغة، حذف المنتج بالكامل
        if (empty($cart[$productId]['quantity'])) {
            unset($cart[$productId]);
        }
        
        // حفظ التغييرات
        Session::put("cart-$userId", $cart);
        return true;
    }
    
    return false;
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

public function removeFromSessionCart($productId = null, $removeAll = false)
{
    $userId = Auth::getUser()->id;
    
    if ($removeAll) {
        // Remove entire cart
        Session::forget("cart-$userId");
    } elseif ($productId) {
        // Remove specific product
        $cart = Session::get("cart-$userId", []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put("cart-$userId", $cart);
        }
    } else {
        // Default: clear entire cart
        Session::forget("cart-$userId");
    }
}

}