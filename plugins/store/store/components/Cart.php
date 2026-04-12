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

        return ['#cart-count' => $cartManager->getCartCount() , '#cart-items' =>  $this->renderPartial('@cart_itmes.htm', ['cartItems' => $cartManager->getCartItems()])];
    }

   

public function onApplyCoupon()
{
    $couponCode = post('coupon_code');
    
    // التحقق من وجود كود الكوبون
    if (!$couponCode) {
        Flash::error('الرجاء إدخال كود الخصم');
        return;
    }
    
    // البحث عن الكوبون في قاعدة البيانات
    $coupon = Coupon::where('code', $couponCode)->where('status', true)->first();
    
    if (!$coupon) {
        Flash::error('كود الكوبون غير صالح!');
        return;
    }
    
    // الحصول على عناصر السلة من الـ Session
    $userId = Auth::getUser()->id;
    $cart = Session::get("cart-$userId", []);
    
    if (empty($cart)) {
        Flash::error('السلة فارغة!');
        return;
    }
    
    // حساب الإجمالي الحالي من السلة
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price_after_taxes'] * $item['quantity'];
    }
    
    // تطبيق الخصم
    $percentage = $coupon->percentage;
    $discountAmount = ($total * $percentage) / 100;
    $newTotal = $total - $discountAmount;
    
    // تخزين الكوبون المطبق في السلة (اختياري)
    Session::put("cart-$userId-coupon", [
        'code' => $coupon->code,
        'percentage' => $percentage,
        'discount_amount' => $discountAmount
    ]);
    
    Flash::success("تم تطبيق خصم {$percentage}% بنجاح! تم خصم $" . number_format($discountAmount, 2));
    
    // إعادة الـ Partial المحدث
    return [
        '#cart-total' => $this->renderPartial('@update_coupon.htm', [
            'old_total' => $total, 
            'percentage' => $percentage, 
            'new_total' => $newTotal,
            'discount_amount' => $discountAmount
        ]),
    ];
}
    
    public function cartItems()
    {
        $cartManager = new CartManager();
        return $cartManager->getCartItems();
    }


       public function onSetCartTotal()
    {
        $total_price = post('total_price', 0);
        $total_promotions = post('total_promotions', 0);
        $final_price = post('final_price', 0);
        $user_id = Auth::getUser()->id;
        
        $cart = CartModel::create([
            'user_id' => $user_id,
            'total_price' => $total_price,
            'total_promotions' => $total_promotions,
            'final_price' => $final_price,
            'status' => false,
            'type' => 'cashe',
        ]);
        
        $cartItems = (new CartManager())->getCartItems();
        
        $cart->items()->createMany(
            array_map(function($item) use ($user_id) {
                return [
                    'product_id' => $item['id'],
                    'qty' => $item['quantity'],
                    'price' => $item['price_after_taxes'],
                    'user_id' => $user_id,
                    'promotion_id' => null,
                ];
            }, $cartItems)
        );
        
        (new CartManager())->removeFromSessionCart(); 
        
        
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
