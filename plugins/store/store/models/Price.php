<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Price extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
  

    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_prices';

        /**
     * @var array Validation rules
     */
    public $rules = [
        'price' => 'required|numeric|min:0',
        'product_id' => 'required|exists:store_store_products,id',
        'status' => 'required|boolean'
    ];

    protected $fillable = ['price' , 'product_id' , 'status'];

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
