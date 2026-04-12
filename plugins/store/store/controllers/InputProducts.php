<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class InputProducts extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'input_products' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Store.Store', 'store', 'input_products');
    }
}
