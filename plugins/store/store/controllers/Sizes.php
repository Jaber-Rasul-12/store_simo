<?php namespace Store\Store\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Store\Store\Models\Size;

class Sizes extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'sizes' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Store.Store', 'setting_store', 'sizes');
    }

    // تحديث الإشعارات
    public function onRefreshNotifications()
    {
        $id = post('id');
        $size = Size::find($id);
        
        if (!$size) {
            throw new \ApplicationException('المقاس غير موجود');
        }
        
        $this->vars['size'] = $size;
        
        return [
            '#Form-field-Size-notifications' => $this->makePartial('~/plugins/store/store/models/size/_notifications_table.htm')
        ];
    }
    
    // تعيين إشعار كمقروء
    public function onMarkAsRead()
    {
        $notificationId = post('notification_id');
        $sizeId = post('id');
        
        $size = Size::find($sizeId);
        if ($size) {
            $notification = $size->notifications()->find($notificationId);
            if ($notification && !$notification->read_at) {
                $notification->read_at = now();
                $notification->save();
                
                \Flash::success('تم تعيين الإشعار كمقروء');
            }
        }
        
        return $this->onRefreshNotifications();
    }
    
    // تعيين كل الإشعارات كمقروءة
    public function onMarkAllAsRead()
    {
        $sizeId = post('id');
        $size = Size::find($sizeId);
        
        if ($size) {
            $size->notifications()
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
                
            \Flash::success('تم تعيين جميع الإشعارات كمقروءة');
        }
        
        return $this->onRefreshNotifications();
    }
}
