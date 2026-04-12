<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Carts extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'  ,'Backend\Behaviors\RelationController'  ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'relation_config.yaml';

    public $requiredPermissions = [
        'carts' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Store.Store', 'store', 'carts');
    }
}
