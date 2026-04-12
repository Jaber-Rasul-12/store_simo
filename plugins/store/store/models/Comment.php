<?php namespace Store\Store\Models;

use Model;

/**
 * Model
 */
class Comment extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    



    /**
     * @var string The database table used by the model.
     */

    public $fillable = ['comment', 'user_id', 'rating' , 'product_id'];
    public $table = 'store_store_comments';

        public $rules = [
        'comment' => 'required|min:3|max:1000',
        'user_id' => 'required|exists:users,id',
        'rating' => 'required|numeric|min:1|max:5',
        'product_id' => 'required|exists:store_store_products,id',
    ];


        public $belongsTo = [
        'user' => ['Winter\User\Models\User', 'key' => 'user_id'], 
        'product' => [Product::class, 'key' => 'product_id'],

    ];



}
