<?php namespace Wallet\Wallet;

use System\Classes\PluginBase;
use Winter\User\Models\User;

class Plugin extends PluginBase
{

    public $require = ['Winter.User'];


       // ...
    public function boot()
    {
        User::extend(function ($model) {
            
            $model->addHasOneRelation('wallets', [\Wallet\Wallet\Models\Wallet::class, 'key' => 'user_id'
                
            ]);

            
        });
    }
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
