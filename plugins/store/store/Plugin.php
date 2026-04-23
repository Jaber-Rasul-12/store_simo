<?php namespace Store\Store;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public $require = ['Winter.User' , 'Wallet.Wallet'];
    public function registerComponents()
    {
        return [
            'Store\Store\Components\Store' => 'Store',
            'Store\Store\Components\Cart' => 'Cart',
            'Store\Store\Components\AccountUserFrontEnd' => 'AccountUserFrontEnd'

            

        ];
    }

    public function registerSettings()
    {
    }

//  public function registerNotificationRules()
//     {
//         return [
//             'events' => [
//                 \Store\Store\NotifyRules\SizeEvent::class,
//             ],
//             'actions' => [
//                 \Winter\Notify\NotifyRules\SaveDatabaseAction::class, 
//             ],
//             'groups' => [
//                 'store' => [
//                     'label' => 'المتجر',
//                     'icon' => 'icon-shopping-cart'
//                 ],
//             ],
//             'presets' => '$/store/store/config/notify_presets.yaml',
//         ];
//     }

//     public function boot()
//     {
//         // ربط جميع أحداث المقاسات بنفس الحدث
//         \Winter\Notify\Classes\Notifier::bindEvents([
//             'store.size.created' => \Store\Store\NotifyRules\SizeEvent::class,
//             'store.size.updated' => \Store\Store\NotifyRules\SizeEvent::class,
//             'store.size.deleted' => \Store\Store\NotifyRules\SizeEvent::class,
//         ]);
        
//         // تسجيل قناة قاعدة البيانات
//         \Winter\Notify\NotifyRules\SaveDatabaseAction::extend(function ($action) {
//             $action->addTableDefinition([
//                 'label'    => 'إشعارات المقاسات',
//                 'class'    => \Store\Store\Models\Size::class,
//                 'relation' => 'notifications',
//                 'param'    => 'size'
//             ]);
//         });
//     }

}