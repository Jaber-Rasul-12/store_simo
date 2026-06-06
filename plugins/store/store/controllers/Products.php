<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Store\Store\Models\Product;
use Redirect;
use Backend;

class Products extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'  , \Backend\Behaviors\RelationController::class,   ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $relationConfig = 'relation_config.yaml';

    public $requiredPermissions = [
        'products' 
    ];

    public function __construct()
    {
        parent::__construct();
    }


            public function formGetRedirectUrl($context = null, $model = null)
    {
        $url = post('url');


        if (($url == 'create') && !empty($url)) {
            return "store/store/products/create";
        } else {
            if ((post("close") == 1) && !empty(post("close"))) {
                return "store/store/products";
            } else {
                return "store/store/products/update/$model->id";
            }
        }
    }

public function onNextProduct($id)
{
    $currentProduct = Product::find($id);

    if (!$currentProduct) {
        Flash::error('المنتج غير موجود.');
        return Redirect::back();
    }

    // البحث عن المنتج التالي الموجود (أي ID أكبر من الحالي)
    $nextProduct = Product::where('id', '>', $currentProduct->id)
        ->orderBy('id', 'asc')
        ->first();

    if (!$nextProduct) {
        Flash::error('المنتج غير موجود.');
        return Redirect::back();
    }

    // التوجيه إلى المنتج التالي (باستخدام ID الفعلي الذي تم العثور عليه)
    return Redirect::to(Backend::url("store/store/products/update/{$nextProduct->id}"));
}

public function onPreviousProduct($id)
{
    $currentProduct = Product::find($id);

    if (!$currentProduct) {
        Flash::error('المنتج غير موجود.');
        return Redirect::back();
    }

    // البحث عن المنتج السابق الموجود (أي ID أصغر من الحالي)
    $prevProduct = Product::where('id', '<', $currentProduct->id)
        ->orderBy('id', 'desc')
        ->first();

    if (!$prevProduct) {
        Flash::error('لا يوجد منتج سابق.');
        return Redirect::back();
    }

    // التوجيه إلى المنتج السابق
    return Redirect::to(Backend::url("store/store/products/update/{$prevProduct->id}"));
}
}
