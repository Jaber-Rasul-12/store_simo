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
    use \Winter\Storm\Database\Traits\Nullable;

    
  

    protected $nullable = ['price_merchant' , 'profit_percentage'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_prices';

        /**
     * @var array Validation rules
     */
    public $rules = [
        'price' => 'required|numeric|min:0',
        'price_merchant' => 'nullable|numeric|min:0',
        'profit_percentage' => 'nullable|numeric|min:0',
        'product_id' => 'required|exists:store_store_products,id',
        'status' => 'required|boolean'
    ];

    protected $fillable = ['price' , 'price_merchant' , 'profit_percentage' , 'product_id' , 'status'];

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

    /**
   * Filter and set options for form fields based on certain conditions.
   *
   * @param object $fields   The form fields.
   * @param mixed  $context  Additional context information if needed.
   *
   */
public function filterFields($fields, $context = null)
{
    if($context === 'create') {
        // التحقق من وجود القيم وعدم كونها فارغة
        if (isset($fields->price_merchant->value, $fields->profit_percentage->value) 
            && !empty($fields->price_merchant->value) 
            && !empty($fields->profit_percentage->value)) {
            
            // جلب القيم وتحويلها إلى أرقام عشرية (float)
            $priceMerchant = (float) $fields->price_merchant->value;
            $profitPercentage = (float) $fields->profit_percentage->value;
            
            // حساب سعر البيع: السعر الأصلي + (السعر الأصلي * نسبة الربح المئوية / 100)
            $calculatedPrice = $priceMerchant * (1 + ($profitPercentage / 100));
            
            // تعيين القيمة المحسوبة لحقل price
            $fields->price->value = $calculatedPrice;
        }
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
