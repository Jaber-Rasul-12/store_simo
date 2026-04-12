<?php namespace Store\Store\Models;

use Model;
use Store\Store\Services\EmailVerificationService;

// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class EmailSubscribe extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    


    public $fillable =['email'];
    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_emailsubscribes';

  /**
     * @var array Validation rules
     */
    public $rules = [
        'email' => 'required|email|unique:store_store_emailsubscribes,email',
    ];
    
    /**
     * @var array Attribute names to encode and decode using JSON.
     */
    public $jsonable = [];


    public function beforeCreate(){
        $object_email_vertifiy = new EmailVerificationService();
        if(!$object_email_vertifiy->verifyEmail($this->email)){
            throw new \ValidationException(['name' =>  trans('store.store::lang.plugin.Invalid_email')]);
        }
         
    }

}
