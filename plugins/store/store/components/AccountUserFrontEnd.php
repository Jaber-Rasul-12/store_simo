<?php namespace Store\Store\Components;

use Cms\Classes\ComponentBase;
use Flash;
use Winter\User\Facades\Auth;
use Winter\Storm\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Input;

class AccountUserFrontEnd extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'AccountUserFrontEnd Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [];
    }

   public function onChangePasswordNew()
{
    $data = post();
    
    // Define validation rules
    $rules = [
        'currentPassword' => 'required',
        'newPassword' => 'required|min:8|different:currentPassword',
        'password_confirmation' => 'required|same:newPassword'
    ];
    
    $messages = [
        'currentPassword.required' => 'كلمة المرور الحالية مطلوبة.',
        'newPassword.required' => 'كلمة المرور الجديدة مطلوبة.',
        'newPassword.min' => 'كلمة المرور الجديدة يجب أن تكون على الأقل 8 أحرف.',
        'newPassword.different' => 'كلمة المرور الجديدة يجب أن تكون مختلفة عن كلمة المرور الحالية.',
        'password_confirmation.required' => 'تأكيد كلمة المرور مطلوب.',
        'password_confirmation.same' => 'كلمة المرور الجديدة وتأكيدها غير متطابقين.'
    ];
    
    $validator = Validator::make($data, $rules, $messages);
    
    if ($validator->fails()) {
        throw new \ValidationException($validator);
    }
    
    $currentPassword = $data['currentPassword'];
    $newPassword = $data['newPassword'];
    
    // Check if current password is correct
    if ($this->checkPassword($currentPassword)) {
        // Get the current user
        $user = Auth::getUser();
        
        // Set the new password (Winter CMS will automatically hash it)
        $user->password = $newPassword;
        $user->password_confirmation = $data['password_confirmation'];

        if ($user->save()) {
            Flash::success('تم تغيير كلمة المرور بنجاح!');
            return redirect('/login');
        } else {
            Flash::error('حدث خطأ أثناء تحديث كلمة المرور.');
            return;
        }
        
    } else {
        Flash::error('كلمة المرور الحالية غير صحيحة.');
    }
}


    public function onUpdateAvatar()
    {
        $user = Auth::getUser();
        
        $avatar = Input::file('avatar');
        
        if ($avatar) {
            // Validate the image
            $rules = ['avatar' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif'];
            $validation = Validator::make(['avatar' => $avatar], $rules);
            
            if ($validation->fails()) {
                Flash::error('الصورة غير صالحة. يجب أن تكون صورة (jpeg, png, jpg, gif) بحجم لا يتجاوز 2 ميجابايت.');
                return;
            }
            
            // Delete old avatar if exists
            if ($user->avatar && !$user->avatar->is_default) {
                $user->avatar->delete();
            }
            
            // Save new avatar
            $user->avatar = $avatar;
            
            if ($user->save()) {
                Flash::success('تم تحديث الصورة الشخصية بنجاح!');
            } else {
                Flash::error('حدث خطأ أثناء تحديث الصورة الشخصية.');
            }
        } else {
            Flash::error('الرجاء اختيار صورة.');
        }
        
        return redirect()->refresh();
    }

public function checkPassword($password)
{
    return Hash::check($password, Auth::getUser()->password);
}
}
