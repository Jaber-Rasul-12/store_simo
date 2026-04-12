<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Promotion extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
  


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_promotions';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:store_store_promotions,code',
        'product_id' => 'required|exists:store_store_products,id',
        'discount_value' => 'required|numeric|min:0',
        'description' => 'required|string',
        'start_date' => 'required|date|before_or_equal:end_date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'boolean',
      
    ];


    /**
     * Relationships
     */
    public $belongsTo = [
        'product' => [Product::class, 'key' => 'product_id']
    ];

    public function beforeValidate()
    {
        // Ensure status is boolean
        $this->status = (bool) $this->status;
    }

        public function beforeCreate()
    {
        if ($this->status) {
            $this->checkUnique();
        }
    }

    public function beforeUpdate()
    {
        $originalValues = $this->getOriginal();
        if (($originalValues['status'] == false) && ($this->status == true)) {
            $this->checkUnique();
        }
    }

    protected function checkUnique()
    {
        $exists = self::where('product_id', $this->product_id)
            ->where('status', true)
            ->exists();

        if ($exists) {
            throw new \ValidationException(['status' => trans('store.store::lang.plugin.error_status_save')]);
        }
    }
}
