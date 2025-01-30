<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('front.profiles.profile');

    }


    public function profile()
{
    $orders = Order::where('user_id', Auth::id())->latest()->get();
    dd($orders->toArray()); // هتوقف التنفيذ وتعرض البيانات مباشرة
    return view('front.profiles.profile', compact('orders'));
}
}
