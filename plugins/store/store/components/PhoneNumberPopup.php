<?php namespace Store\Store\Components;

use Cms\Classes\ComponentBase;
use Winter\User\Facades\Auth;
use Flash;

class PhoneNumberPopup extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Phone Number Popup',
            'description' => 'Shows popup for users without phone number'
        ];
    }
    
    public function defineProperties()
    {
        return [
            'delay' => [
                'title' => 'Popup Delay',
                'description' => 'Delay in milliseconds before showing popup',
                'default' => 1000,
                'type' => 'string'
            ]
        ];
    }

     public function prepareVars()
    {
        $user = Auth::getUser();
        $this->page['user'] = $user;
        $this->page['showPopup'] = $this->shouldShowPopup();
        $this->page['popupDelay'] = $this->property('delay');
    }
    
    public function onRun()
    {
         $this->prepareVars();
    }
    
    public function shouldShowPopup()
    {
        $user = Auth::getUser();
        // التحقق من وجود المستخدم وعدم وجود رقم هاتف
        return $user && empty($user->phone);
    }
    
public function onUpdatePhoneNumber()
{
    $user = Auth::getUser();
    
    if (!$user) {
        return ['success' => false, 'error' => 'يجب تسجيل الدخول أولاً'];
    }
    
    $phoneNumber = post('phone_number');
    
    // التحقق من صحة الرقم
    if (empty($phoneNumber) || !preg_match('/^[0-9]{10,15}$/', $phoneNumber)) {
        return ['success' => false, 'error' => 'الرجاء إدخال رقم موبايل صحيح (10-15 رقم)'];
    }
    
    // التحقق من أن رقم الموبايل فريد (غير مستخدم من قبل)
    $existingUser = \Winter\User\Models\User::where('phone', $phoneNumber)
        ->where('id', '!=', $user->id)
        ->first();
    
    if ($existingUser) {
        Flash::error('رقم الموبايل هذا مستخدم بالفعل من قبل مستخدم آخر');
        
    }
    
    try {
        $user->phone = $phoneNumber;
        $user->save();
        

        \Flash::success('تم تحديث رقم الموبايل بنجاح');
        
        // إعادة تحميل الصفحة
        return redirect()->refresh();
    } catch (\Exception $e) {
        return ['success' => false, 'error' => 'حدث خطأ: ' . $e->getMessage()];
    }
}

}   