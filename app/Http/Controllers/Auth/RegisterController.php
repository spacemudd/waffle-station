<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // حفظ المستخدم في قاعدة البيانات
        $user = new User;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        Log::info('Registering user with data: ', $request->all());
        // تشفير كلمة المرور
        if ($user->save()) {
            Log::info('User saved successfully.');
        } else {
            Log::error('Failed to save user.');
        }


        

        // التوجيه إلى صفحة تسجيل الدخول أو صفحة أخرى
        return redirect()->route('home')->with('success', 'Account created successfully. Please log in.');
    }
}
