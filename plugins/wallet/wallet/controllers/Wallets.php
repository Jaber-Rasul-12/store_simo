<?php namespace Wallet\Wallet\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Wallets extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'wallets' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Wallet.Wallet', 'wallet', 'wallets');
    }
}
