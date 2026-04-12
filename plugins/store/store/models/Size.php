<?php namespace Store\Store\Models;

use Model;

use Winter\Notify\Models\Notification;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Size extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_sizes';

    /**
     * @var array Validation rules
     */
      public $rules = [
        'name' => 'required|unique:store_store_sizes,name|max:255',
    ];


    public $belongsToMany = [
        'products' => ['Store\Store\Models\Product', 'table' => 'store_store_products_sizes'],
    ];


        // ⭐ فقط أضف هذه العلاقة
    public $morphMany = [
        'notifications' => [
            Notification::class,
            'name' => 'notifiable'
        ]
    ];
    
    // ⭐ أضف هذه التوابع لإطلاق الأحداث
    public function afterCreate()
    {
        \Event::fire('store.size.created', [$this]);
    }
    
    public function afterUpdate()
    {
        \Event::fire('store.size.updated', [$this]);
    }
    
    public function beforeDelete()
    {
        \Event::fire('store.size.deleted', [$this]);
    }

   

}
