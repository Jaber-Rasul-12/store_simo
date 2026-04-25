<?php namespace Store\Store\Components;

use Winter\User\Facades\Auth;
use Cms\Classes\ComponentBase;
use Store\Store\Models\Category;
use Store\Store\Models\EmailSubscribe;
use Store\Store\Models\Product;
use Store\Store\Models\ReturnPolicy;
use Flash;
use Store\Store\Models\Brand;
use Store\Store\Models\Color;
use Store\Store\Models\Comment;
use Store\Store\Models\ContactMessage;
use Store\Store\Models\Size;

class Store extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Store Component',
            'description' => 'No description provided yet...'
        ];
    }


        public function onGetProductWithSlug()
    {
        $slug =  $this->param('slug');
        if (isset($slug) && !empty($slug)) {
            return Product::with('prices')->where('slug', $slug)->get()->first();
        } else {
            return null;
        }
    }


    public function onAddComment()
    {
        $product_id = post('product_id');
        $comment = post('comment');
        $user_id = Auth::getUser()->id;
        $rating = post('rating');

        if (Comment::create(['product_id' => $product_id, 'comment' => $comment, 'user_id' => $user_id, 'rating' => $rating])) {
            Flash::success(trans('store.store::lang.plugin.success_save_comment'));

            $product_comments = Comment::where('product_id', $product_id)->get();
            
         return redirect('detail/' . $this->param('slug'));
        } else {
            Flash::error(trans('store.store::lang.plugin.please_check_your_input'));
        }
    }

    public function onSearchProductsWithCategory()
    {
        $queryString = post('text');
        $slug =  $this->param('slug');
        $Categories = Category::where('name', 'LIKE', "%" . $queryString . "%")->where('status' ,'=', true)->get();
        if (isset($slug) && !empty($slug)) {
            $products = Product::with('prices')->whereHas('categories', function($query) use ($slug) {
                $query->where('slug', $slug);
            })->where('status', '=', true)->where('name', 'like', '%' . $queryString . '%')->orderBy('id' , 'desc')->get();
            return ['#products-list_container' => $this->renderPartial('@products_lists_container.htm', ['GetAllProducts' => $products])];
        } else {
            return null;
        }
        
    }

     public function onSearchProductsWithBrand()
    {
        $queryString = post('name_brand');
        $slug =  $this->param('slug');
        $Categories = Brand::where('name', 'LIKE', "%" . $queryString . "%")->where('status' ,'=', true)->get();
        if (isset($slug) && !empty($slug)) {
            $products = Product::with('prices')->whereHas('brand', function($query) use ($slug) {
                $query->where('slug', $slug);
            })->where('status', '=', true)->where('name', 'like', '%' . $queryString . '%')->orderBy('id' , 'desc')->get();
            return ['#products-list_container' => $this->renderPartial('@products_lists_container.htm', ['GetAllProducts' => $products])];
        } else {
            return null;
        }
        
    }



    




    
    public function onGetProductsWhereCategory()
    {
        $slug =  $this->param('slug');
        if (isset($slug) && !empty($slug)) {
            return Product::with('prices')->whereHas('categories', function($query) use ($slug) {
                $query->where('slug', $slug);
            })->where('status', '=', true)->orderBy('id' , 'desc')->get();
        } else {
            return null;
        }
    }

    public function onGetRelatedCategories()
    {
        $slug = $this->param('slug');
    
        if (!$slug) {
            return null;
        }
    
        $category = Category::where('slug', $slug)
            ->where('status', true)
            ->first();
    
        if (!$category) {
            return null;
        }
    
        return $category->related_categories()->withCount('products')->where('status', true)->get();
    }
    public function onGetRelatedProducts()
    {
        $slug = $this->param('slug');
    
        if (!$slug) {
            return null;
        }
    
        $category = Product::where('slug', $slug)
            ->where('status', true)
            ->first();
    
        if (!$category) {
            return null;
        }
    
        return $category->related_products()->where('status', true)->get();
    }
    public function onGetRelatedBrands()
    {
        $slug = $this->param('slug');
    
        if (!$slug) {
            return null;
        }
    
        $category = Brand::where('slug', $slug)
            ->where('status', true)
            ->first();
    
        if (!$category) {
            return null;
        }
    
        return $category->related_brands()->withCount('products')->where('status', true)->get();
    }


    

    public function onGetProductsWhereBrand()
    {
        $slug =  $this->param('slug');
        if (isset($slug) && !empty($slug)) {
            return Product::with('prices')->whereHas('brand', function($query) use ($slug) {
                $query->where('slug', $slug);
            })->where('status', '=', true)->orderBy('id' , 'desc')->get();
        } else {
            return null;
        }
    }

    public function onGetProductsWherePromotions()
    {
       
       
        return Product::whereHas('promotions', function ($query) {
            $query->where('status', '=', true);
        })->where('status', '=', true)->get();
        
    }

         public function onSearchProductsWithPromotions()
    {
        $queryString = post('name_promotions');
        if (isset($queryString) && !empty($queryString)) {
            $products = Product::whereHas('promotions', function ($query) {
            $query->where('status', '=', true);
        })->where('status', '=', true)->where('name', 'like', '%' . $queryString . '%')->orderBy('id' , 'desc')->get();
            return ['#products-list_container' => $this->renderPartial('@products_lists_container.htm', ['GetAllProducts' => $products])];
        } else {
            return null;
        }
        
    }



    

    

     public function onSearchSuggestions()
    {
        $searchTerm = post('search');
        $filteredSuggestions = Product::where('name', 'like', '%' . $searchTerm . '%')->get();
        
        if ($filteredSuggestions->isEmpty() ) {
            return [
                '#searchSuggestions' =>  '<div class="p-3 text-center text-muted">لا توجد اقتراحات</div>',
            ];
        }

        if ( $searchTerm == '') {
            return [
                '#searchSuggestions' =>  '',
            ];
        }
        return [
            '#searchSuggestions' =>  $this->renderPartial('@suggestionsList.htm', ['suggestions' => $filteredSuggestions]),
        ];
    }


     public function onSendMessage()
    {
        $full_name = post('full_name');
        $email = post('email');
        $subject = post('subject');
        $message = post('message');

        if (ContactMessage::create(['full_name' => $full_name, 'email' => $email, 'subject' => $subject, 'message' => $message])) {
            Flash::success(trans('store.store::lang.plugin.success_save'));
        } else {
            Flash::error(trans('store.store::lang.plugin.please_check_your_input'));
        }
    }


    public function onSaveEmail()
    {
        $email = post('email');
        EmailSubscribe::create(['email' => $email]);
        Flash::success('save');
    }


    public function onGetAllProducts()
    {
        return Product::with('prices')->where('status', '=', true)->orderBy('id' , 'desc')->paginate(18);
    }

    public function onGetAllColors()
    {
        return Color::get();
    }   

    public function onGetAllSizes()
    {
        return Size::get();
    }   

    

    public function onGetProductsIsBest()
    {
        return Product::with('prices')->where('is_best', '=', true)->where('status', '=', true)->orderBy('id' , 'desc')->get()->take(12);
    }

    public function onGetProductsIsFeatured()
    {
        return Product::with('prices')->where('is_featured', '=', true)->where('status', '=', true)->orderBy('id' , 'desc')->get()->take(12);
    }
    public function onGetProductsNew()
    {
        return Product::with('prices')->where('new_product', '=', true)->where('status', '=', true)->orderBy('id' , 'desc')->get()->take(12);
    }
    public function onGetProductsIsTop()
    {
        return Product::with('prices')->where('is_top', '=', true)->where('status', '=', true)->orderBy('id' , 'desc')->get()->take(12);
    }
    


    



    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [];
    }

    public function getCateogries()
    {
        return Category::with('subcategories')->withCount('products')->where('status' ,'=', true)->get();
    }

    public function getBrands()
    {
        return Brand::withCount('products')->where('status' ,'=', true)->get();
    }

public function getCateogriesOnHomePage()
{


    return Category::withCount(['products' => function($query) {
        $query->where('status', '=', true);
    }])
    ->where('status', '=', true)
    ->where('show_homepage', '=', true)
    ->get();
}
    public function getProductsShowHomePage()
    {
        return Product::whereHas('promotions', function ($query) {
            $query->where('status', '=', true);
        })->where('status', '=', true)->get();
    }

    public function onSearchCategories()
    {
        $queryString = post('text');
        $Categories = Category::withCount('products')->where('name', 'LIKE', "%" . $queryString . "%")->where('status' ,'=', true)->get();
        return ['#categories-items' => $this->renderPartial('@search_categories.htm', ['Categories' => $Categories])];
    }

    public function onSearchBrands()
    {
        $queryString = post('name_brands');
        $Brands = Brand::withCount('products')->where('name', 'LIKE', "%" . $queryString . "%")->where('status' ,'=', true)->get();
        return ['#brands-items' => $this->renderPartial('@search_brands.htm', ['Brands' => $Brands])];
    }


    


    public function onSearchProductsOnShop()
    {
        $queryString = post('text');
        $GetAllProducts = Product::where('name', 'LIKE', "%" . $queryString . "%")->where('status' ,'=', true)->orderBy('id' , 'desc')->paginate(6);
        return ['#mshop-products-list' => $this->renderPartial('@mshop_products_list.htm', ['GetAllProducts' => $GetAllProducts])];
    }

    public function onFilterProductsWithPrice()
    {
        $minPrice = post('minPrice');
        $maxPrice = post('maxPrice');

        if($minPrice > 0 && $maxPrice > 0 && !is_null($minPrice) && !is_null($maxPrice)){
             $GetAllProducts = Product::whereHas('prices', function ($query) use ($minPrice, $maxPrice) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        })->where('status' ,'=', true)->get();
        }else if ($minPrice > 0 && (is_null($maxPrice) || $maxPrice == 0)){
             $GetAllProducts = Product::whereHas('prices', function ($query) use ($minPrice) {
            $query->where('price', '>=', $minPrice);
        })->where('status' ,'=', true)->get();
        } else if ($maxPrice > 0 && (is_null($minPrice) || $minPrice == 0)){
             $GetAllProducts = Product::whereHas('prices', function ($query) use ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        })->where('status' ,'=', true)->get();
        } else {
            $GetAllProducts = Product::where('status' ,'=', true)->orderBy('id' , 'desc')->paginate(6);
        }
       
        return ['#mshop-products-list' => $this->renderPartial('@mshop_products_list.htm', ['GetAllProducts' => $GetAllProducts])];
    }

    public function onFilterProductsWithColor()
    {
        $color = post('colors' , []);
        

        $GetAllProducts = Product::whereHas('colors', function ($query) use ($color) {
            $query->whereIn('code',  $color);
        })->where('status' ,'=', true)->get();
      
       
        return ['#mshop-products-list' => $this->renderPartial('@mshop_products_list.htm', ['GetAllProducts' => $GetAllProducts])];
    }

    public function onFilterProductsWithSizes()
    {
        $size = post('sizes' , []);
        

        $GetAllProducts = Product::whereHas('sizes', function ($query) use ($size) {
            $query->whereIn('name',  $size);
        })->where('status' ,'=', true)->get();
      
       
        return ['#mshop-products-list' => $this->renderPartial('@mshop_products_list.htm', ['GetAllProducts' => $GetAllProducts])];
    }

    





    


    public function onReturnPolicies(){
        return ReturnPolicy::where('status', '=', true)->get();
    }

    
}
