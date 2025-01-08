<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);  // تسجيل دخول المستخدم
            return redirect()->route('home');
        } else {
            // في حال فشل تسجيل الدخول
            return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
        }
    }
    


    public function logout()
    {
        Auth::logout();
        session()->invalidate();  // مسح الجلسة
        session()->regenerateToken();  // تجديد الـ CSRF token
        return redirect()->route('home');
    }
    
}
