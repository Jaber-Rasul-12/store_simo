<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class ContactMessage extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
    public $fillable = ['full_name', 'email', 'subject', 'message'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_contact_messages';

  /**
     * @var array Validation rules
     */
    public $rules = [
        'full_name' => 'required|string|min:3|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|min:10',
    ];


    public function beforeCreate()
    {
        $email = $this->email;
        if (self::where('email', $email)->where('is_read', false)->exists()) {
            throw new \ValidationException(['email' => trans('store.store::lang.plugin.email_error_message')]);
        }
    }

}
