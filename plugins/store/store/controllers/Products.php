<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Products extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'  , \Backend\Behaviors\RelationController::class,   ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $relationConfig = 'relation_config.yaml';

    public $requiredPermissions = [
        'products' 
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
