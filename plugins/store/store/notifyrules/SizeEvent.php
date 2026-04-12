<?php namespace Store\Store\NotifyRules;

use Winter\Notify\Classes\EventBase;

class SizeEvent extends EventBase
{
    public function eventDetails()
    {
        return [
            'name'        => 'حدث المقاسات',
            'description' => 'أي حدث متعلق بالمقاسات (إنشاء، تحديث، حذف)',
            'group'       => 'store'
        ];
    }

    public function defineParams()
    {
        return [
            'size' => [
                'title' => 'المقاس',
                'description' => 'بيانات المقاس',
            ],
            'name' => [
                'title' => 'اسم المقاس',
            ],
            'action' => [
                'title' => 'نوع الإجراء',
                'description' => 'إنشاء، تحديث، أو حذف',
            ],
        ];
    }

    public static function makeParamsFromEvent(array $args, $eventName = null)
    {
        $size = array_get($args, 0);
        
        // تحديد نوع الإجراء من اسم الحدث
        $action = 'حدث';
        if ($eventName === 'store.size.created') {
            $action = 'إنشاء';
        } elseif ($eventName === 'store.size.updated') {
            $action = 'تحديث';
        } elseif ($eventName === 'store.size.deleted') {
            $action = 'حذف';
        }
        
        return [
            'size' => $size,
            'name' => isset($size->name) ? $size->name : 'غير معروف',
            'action' => $action,
            'event_name' => $eventName,
            'timestamp' => now(),
        ];
    }
}