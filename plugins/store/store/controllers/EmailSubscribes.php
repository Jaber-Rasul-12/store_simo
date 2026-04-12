<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class EmailSubscribes extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'emailsubscribes' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Store.Store', 'setting_store', 'emailsubscribes');
    }
}
