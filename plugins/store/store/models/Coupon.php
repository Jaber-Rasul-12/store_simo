<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Coupon extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_coupons';

       /**
     * @var array Validation rules
     */
    public $rules = [
        'full_name' => 'required|string|max:255',
        'code' => 'required|string|unique:store_store_coupons,code|max:255',
        'status' => 'boolean',
        'percentage' => 'required|numeric|min:0|max:100',
        'information' => 'nullable|array',
    ];
    


    public $hasMany = [
        'carts' => [Cart::class, 'key' => 'coupon_id']
    ];

    /**
     * Specifies attributes that should be stored as JSON.
     *
     * - The 'information' attribute is stored as a JSON-encoded string in the database.
     *
     * @var array
     */
    protected $jsonable = ['information'];
    
    /**
     * Defines attribute type casting.
     *
     * - The 'information' attribute is cast to an array for easy manipulation.
     *
     * @var array
     */
    protected $casts = [
        'information' => 'array',
    ];
    
    /**
     * Get the formatted key-value pairs from the 'information' attribute.
     *
     * - Retrieves key-value pairs from the 'information' attribute of the model.
     * - Formats each key-value pair as a string using '::' as a separator.
     * - Joins all formatted pairs into a single string separated by commas.
     *
     * @return string Formatted key-value pairs as a string.
     */
    public function getInformationKeyValueAttribute()
    {
        $informationArray = $this->information;
    
        // Ensure $informationArray is an array
        if (!is_array($informationArray)) {
            $informationArray = [];
        }
    
        $keyValuePairs = collect($informationArray)->map(function ($item) {
            return $item['key'] . ' :: ' . $item['value'];
        });
    
        return $keyValuePairs->implode(', ');
    }

    
    /**
     * Get dropdown options for a specified field.
     *
     * - This method is used to provide dropdown options dynamically.
     * - It accepts the field name, current value, and form data as parameters.
     * - Returns an array of options that can be used in dropdown selections.
     *
     * @param  string  $fieldName The name of the field for which options are retrieved.
     * @param  mixed   $value The current value of the field.
     * @param  array   $formData The form data available for context.
     * @return array   An array of dropdown options.
     */
    public function getDropdownOptions($fieldName, $value, $formData)
    {
        return [];
    }




}
