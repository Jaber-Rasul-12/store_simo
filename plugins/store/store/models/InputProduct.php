<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
use BackendAuth;
/**
 * Model
 */
class InputProduct extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
  

    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_input_products';


       /**
     * @var array Validation rules
     */
    public $rules = [
        'product_id' => 'required|exists:store_store_products,id',
        'notes' => 'nullable|string|max:1000',
        'qty' => 'required|numeric|min:0.01',
        'backend_user_id' => 'required|exists:backend_users,id',
    ];



    /**
     * Relationships
     */
    public $belongsTo = [
        'product' => [Product::class, 'key' => 'product_id'],
        'backend_user' => [\Backend\Models\User::class, 'key' => 'backend_user_id'],
    ];


    /**
     * Before validate event
     */
    public function beforeValidate()
    {
        if (!$this->backend_user_id) {
            $this->backend_user_id = BackendAuth::getUser()->id;
        }
    }

    /**
     * After save event - update product quantity
     */
    public function afterSave()
    {
        $this->updateProductQuantity();
    }

    /**
     * After delete event - revert product quantity
     */
    public function afterDelete()
    {
        $this->revertProductQuantity();
    }

    /**
     * Update product quantity based on input
     */
    protected function updateProductQuantity()
    {
        
            // Update product quantity
            $this->product->qty += $this->qty;
            $this->product->save();
        
    }

    /**
     * Revert product quantity when input is deleted
     */
    protected function revertProductQuantity()
    {
        if ($this->product) {
            $this->product->qty -= $this->qty;
            
            // Ensure quantity doesn't go negative
            if ($this->product->qty < 0) {
                $this->product->qty = 0;
            }
            
            $this->product->save();
        }
    }







}
