<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class ReturnPolicy extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
   

    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_return_policies';

    /**
     * @var array Validation rules
     */
       public $rules = [
        'title' => 'required|string|max:255',
        'details' => 'required|string',
        'icon' => 'required|string',
        'status' => 'boolean',
    ];


}
