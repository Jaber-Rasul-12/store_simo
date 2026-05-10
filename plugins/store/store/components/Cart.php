<?php namespace Store\Store\Components;

use Cms\Classes\ComponentBase;
use \Store\Store\Classes\CartManager;
use Flash;
use Store\Store\Models\Coupon;
use Store\Store\Models\Product;
use Store\Store\Models\Cart as CartModel;
use Input;
use Session;
use Winter\User\Facades\Auth;
class Cart extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Cart Component',
            'description' => 'No description provided yet...'
        ];
    }


    function onUpdateQuantityPluseOrSub()
{
   $productId = input('idProduct');
   $quantity = input('Quantity');
        $cartManager = new CartManager();
        $cartManager->addToSessionCart($productId, $quantity );
        return true;
   }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [];
    }

        public function onAddToCart()
    {
        
        $productId = post('product_id');
        $quantity = post('quantity', 1);
       


        $cartManager = new CartManager();
        $cartManager->addToSessionCart($productId, $quantity );
        Flash::success('تمت إضافة المنتج إلى السلة بنجاح!');

        return ['#cart-count' => $cartManager->getCartCount()];
    }

  
function onLoadPageContent()
{
    $id = post('id', 1);   
    $Product = Product::with(['colors' , 'sizes'])->where('id', $id)->get()->first();   
        return ['#winter-popup-content' =>   $this->renderPartial('@popup-partial.htm', ['product' => $Product])];
    
}



    public function getCountCarts()
    {
        $cartManager = new CartManager();

        return $cartManager->getCartCount();
    }

    public function getCountCartsCheckout()
        {
           
    
            return CartModel::where('user_id', Auth::getUser()->id)->where('status', false)->count();
        }

    public function onRemoveFromCart()
    {
        $productId = post('product_id');
        $removeAll = post('remove_all', false);

        $cartManager = new CartManager();
        $cartManager->removeFromSessionCart($productId, $removeAll);
        
        Flash::success('تمت إزالة المنتج من السلة بنجاح!');

        return redirect('cart');
    }

    public function onAddQuantityToProduct(){
        $cartManager = new CartManager();
        $productId = post('product_id');
        $quantity = post('quantity', 1);
        $sizeId = post('size_id', null);
        $colorId = post('color_id', null);
        $cartManager->addQuantityToProduct($productId, $quantity, $sizeId, $colorId);

        Flash::success('تم تحديث كمية المنتج في السلة بنجاح!');
        return redirect('cart');
        
    }


    public function onRemoveColorSizeFromCart(){
        $cartManager = new CartManager();
        $productId = post('product_id');
        $sizeId = post('size_id', null);
        $colorId = post('color_id', null);
        $cartManager->removeQuantityFromProduct($productId, $sizeId, $colorId);

        Flash::success('تم تحديث كمية المنتج في السلة بنجاح!');
        return redirect('cart');
        
    }

    

   

// public function onApplyCoupon()
// {
//     $couponCode = post('coupon_code');
    
//     // التحقق من وجود كود الكوبون
//     if (!$couponCode) {
//         Flash::error('الرجاء إدخال كود الخصم');
//         return;
//     }
    
//     // البحث عن الكوبون في قاعدة البيانات
//     $coupon = Coupon::where('code', $couponCode)->where('status', true)->first();
    
//     if (!$coupon) {
//         Flash::error('كود الكوبون غير صالح!');
//         return;
//     }
    
//     // الحصول على عناصر السلة من الـ Session
//     $userId = Auth::getUser()->id;
//     $cart = Session::get("cart-$userId", []);
    
//     if (empty($cart)) {
//         Flash::error('السلة فارغة!');
//         return;
//     }
    
//     // حساب الإجمالي الحالي من السلة
//     $total = 0;
//     foreach ($cart as $item) {
//         $total += $item['price_after_taxes'] * $item['quantity'];
//     }
    
//     // تطبيق الخصم
//     $percentage = $coupon->percentage;
//     $discountAmount = ($total * $percentage) / 100;
//     $newTotal = $total - $discountAmount;
    
//     // تخزين الكوبون المطبق في السلة (اختياري)
//     Session::put("cart-$userId-coupon", [
//         'code' => $coupon->code,
//         'percentage' => $percentage,
//         'discount_amount' => $discountAmount
//     ]);
    
//     Flash::success("تم تطبيق خصم {$percentage}% بنجاح! تم خصم $" . number_format($discountAmount, 2));
    
//     // إعادة الـ Partial المحدث
//     return [
//         '#cart-total' => $this->renderPartial('@update_coupon.htm', [
//             'old_total' => $total, 
//             'percentage' => $percentage, 
//             'new_total' => $newTotal,
//             'discount_amount' => $discountAmount
//         ]),
//     ];
// }
public function onApplyCoupon()
{

    $coupon = Coupon::where('code' , post('coupon_code'))->where('status', true)->first();
     if (!$coupon) {
        Flash::error('كود الكوبون غير صالح!');
        return;
    }
    $userId = Auth::getUser()->id;
    Session::put("coupon-$userId", [
        'code' => $coupon->code,
        'percentage' => $coupon->percentage,
        'coupon_id' => $coupon->id,
    ]);
    Flash::success("تم تطبيق خصم {$coupon->percentage}% بنجاح!");
    return redirect('cart');
}
    
    public function cartItems()
    {
        $cartManager = new CartManager();
        return $cartManager->getCartItems();
    }

    public function getCoupon()
    {
        $cartManager = new CartManager();
        return $cartManager->getCoupon();
    }

    public function onRemoveCoupon()
    {
        $userId = Auth::getUser()->id;
        Session::forget("coupon-$userId");
        Flash::success('تم إزالة الكوبون بنجاح!');
        return redirect('cart');
    }




public function onSetCartTotal()
{
    $user_id = Auth::getUser()->id;
    
    // جلب عناصر السلة من الجلسة
    $cartItems = (new CartManager())->getCartItems();
    
    // التحقق من وجود عناصر في السلة
    if (empty($cartItems)) {
        Flash::error('سلة التسوق فارغة. يرجى إضافة منتجات قبل متابعة الدفع.');
        return redirect()->back();
    }
    
    // حساب القيم بنفس طريقة Twig
    $totalprice = 0;      // المجموع الفرعي (السعر الأساسي)
    $totaltaxes = 0;      // إجمالي الضرائب
    $totalfinal = 0;      // الإجمالي قبل الخصم (بعد الضرائب)
    
    foreach ($cartItems as $item) {
        // التحقق من وجود الكميات
        if (!isset($item['quantity']) || empty($item['quantity'])) {
            Flash::error('المنتج ' . ($item['name'] ?? 'غير معروف') . ' لا يحتوي على كميات محددة.');
            return redirect()->back();
        }
        
        foreach ($item['quantity'] as $variant) {
            // التحقق من صحة الكمية
            if (!isset($variant['quantity']) || $variant['quantity'] <= 0) {
                Flash::error('المنتج ' . ($item['name'] ?? 'غير معروف') . ' يحتوي على كمية غير صالحة.');
                return redirect()->back();
            }
            
            // حساب المجموع الفرعي (السعر الأساسي × الكمية)
            $item_total = ($item['price_main'] ?? 0) * $variant['quantity'];
            $totalprice += $item_total;
            
            // حساب الضرائب (الفرق بين السعر بعد الضرائب والسعر الأساسي)
            $price_after_taxes = $item['price_after_taxes'] ?? $item['price_main'] ?? 0;
            $tax_amount = ($price_after_taxes - ($item['price_main'] ?? 0)) * $variant['quantity'];
            $totaltaxes += $tax_amount;
            
            // حساب الإجمالي قبل الخصم (السعر بعد الضرائب × الكمية)
            $totalfinal += $price_after_taxes * $variant['quantity'];
        }
    }
    
    // جلب الكوبون المطبق
    $coupon = (new CartManager())->getCoupon();
    $coupon_percentage = $coupon['percentage'] ?? 0;
    $coupon_discount_amount = ($totalfinal * $coupon_percentage) / 100;
    $final_total_after_coupon = $totalfinal - $coupon_discount_amount;
    
    // التحقق من صحة القيم الرقمية
    if ($totalprice <= 0 && $final_total_after_coupon <= 0) {
        Flash::error('لا يمكن متابعة الدفع. قيمة الطلب غير صالحة.');
        return redirect()->back();
    }
    
    // إنشاء سلة التسوق في قاعدة البيانات
    $cart = CartModel::create([
        'user_id' => $user_id,
        'total_price' => $totalprice,                       // المجموع الفرعي
        'total_promotions' => $totaltaxes,                  // إجمالي الضرائب
        'final_price' => $final_total_after_coupon,         // الإجمالي بعد خصم الكوبون
        'status' => false,
        'delivered' => false,
        'coupon_id' => isset($coupon['coupon_id']) ? $coupon['coupon_id'] : null,
        'type' => 'cashe',
    ]);
    
    $cartItemsToInsert = [];
    
    foreach ($cartItems as $item) {
        foreach ($item['quantity'] as $variant) {
            // التحقق الإضافي قبل الإدراج
            if (isset($variant['quantity']) && $variant['quantity'] > 0) {
                $cartItemsToInsert[] = [
                    'product_id' => $item['id'],
                    'qty' => $variant['quantity'], 
                    'price' => $item['price_after_taxes'] ?? $item['price_main'] ?? 0,
                    'user_id' => $user_id,
                    'color_id' => $variant['color_id'] ?? null,
                    'size_id' => $variant['size_id'] ?? null,
                    'promotion_id' => null,
                ];
            }
        }
    }
    
    // التحقق من وجود عناصر للإدراج
    if (empty($cartItemsToInsert)) {
        Flash::error('لا توجد منتجات صالحة للإدراج. يرجى التحقق من الكميات المحددة.');
        return redirect()->back();
    }
    
    // إدراج جميع العناصر دفعة واحدة
    $cart->items()->createMany($cartItemsToInsert);
    
    // تنظيف سلة الجلسة
    (new CartManager())->removeFromSessionCart();
    (new CartManager())->removeCouponFromSessionCart();

    
    // رسالة نجاح
    Flash::success('تم حفظ سلة التسوق الخاصة بك بنجاح وهي جاهزة للدفع!');
    
    return redirect('checkout');
}

    public function GetAllCartItems()
    {
        return  CartModel::where('user_id', Auth::getUser()->id)->get();

    }

    public function onPlaceOrder()
    {
        $cart_id = post('cart_id');
        $my_id = post( 'my_id');
        if(CartModel::where('id', $cart_id)->where('user_id', Auth::getUser()->id)->exists()){
            $cart = CartModel::find($cart_id);
            $cart->status = true;
            $cart->location_lat = post('location_lat');
            $cart->location_lng = post('location_lng');
            $cart->address = post('address');
            $cart->save();
            Flash::success('تم تقديم طلبك بنجاح!');
            // return ["#id_button-{$my_id}" => "<button type='button' class='btn btn-lg btn-block btn-success font-weight-bold my-3 py-3'>الطلب مكتمل</button>"  ];
            return redirect('checkout');
        } else {
            Flash::error('عذراً، لم يتم العثور على سلة التسوق الخاصة بك.');
        }
    }
}
