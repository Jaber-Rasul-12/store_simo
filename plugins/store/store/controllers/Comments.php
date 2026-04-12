<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Comments extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'comments' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Store.Store', 'setting_store', 'comments');
    }
}
