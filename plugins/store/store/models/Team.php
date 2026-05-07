<?php namespace Store\Store\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
class Team extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
   

    /**
     * @var string The database table used by the model.
     */
    public $table = 'store_store_teams';

        /**
     * @var array Validation rules
     */
    public $rules = [
        'full_name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'fs_link' => 'nullable|url|max:255',
        'ins_link' => 'nullable|url|max:255',
        'tw_link' => 'nullable|url|max:255',
        'wh_number' => 'nullable|string|max:20',
        'job' => 'required|string|max:255',
        'type' => 'required|string|in:basics,agent',
        'address' => 'nullable|string|max:255',
    ];

        public $attachOne = [
        'image' =>[\System\Models\File::class] 
    ];

    

}
