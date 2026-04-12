<?php namespace Wallet\Wallet\Models;

use Model;

/**
 * Model
 */
class Transaction extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    


    /**
     * @var string The database table used by the model.
     */
    public $table = 'wallet_wallet_transactions';

        public $rules = [
        'public_id' => 'required|string|unique:wallet_wallet_transactions,public_id',
        'wallet_id' => 'required|exists:wallet_wallet_wallets,id',
        'amount' => 'required|numeric|min:0.01',
        'description' => 'required|string|max:500',
        'status' => 'required|boolean',

    ];
        public $belongsTo = [
        'wallet' => [Wallet::class, 'key' => 'wallet_id']
    ];
      public function beforeValidate()
    {
        if (empty($this->public_id)) {
            $this->public_id = $this->generatePublicId();
        }
    }

    public function afterSave(){
        $this->updateWalletBalance();
    }
        protected function generatePublicId()
    {
        $prefix = 'txn_';
        $uniqueId = uniqid() . '_' . mt_rand(1000, 9999);
        return $prefix . $uniqueId;
    }

     /**
     * Update wallet balance based on transaction
     */
    protected function updateWalletBalance()
    {
        $wallet = $this->wallet;
        $wallet->current_balance += $this->amount;        
        $wallet->save();
    }

}
