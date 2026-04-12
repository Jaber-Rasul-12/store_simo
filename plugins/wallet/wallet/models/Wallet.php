<?php namespace Wallet\Wallet\Models;

use Model;
use Winter\User\Models\User;

// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Wallet extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
  

    /**
     * @var string The database table used by the model.
     */
    public $table = 'wallet_wallet_wallets';

    /**
     * @var array Validation rules
     */


      public $rules = [
        'user_id' => 'required|exists:users,id',
        'current_balance' => 'required|numeric|min:0',
        'status' => 'required|boolean',
    ];

        /**
     * Relationships
     */
    public $belongsTo = [
        'user' => [User::class, 'key' => 'user_id']
    ];

    public $hasMany = [
        'transactions' => [Transaction::class, 'key' => 'wallet_id']
    ];






    public function beforeValidate(){
              if(empty($this->current_balance)){
            $this->current_balance = 0;
        }
    }

          public function beforeCreate()
    {
        if (empty($this->public_id)) {
            $this->public_id = $this->generatePublicId();
        }

    }

            protected function generatePublicId()
    {
        $prefix = 'wallet_';
        $uniqueId = uniqid() . '_' . mt_rand(1000, 9999);
        return $prefix . $uniqueId;
    }




}
