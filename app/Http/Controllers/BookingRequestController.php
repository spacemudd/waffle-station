<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class BookingRequestController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من تسجيل الدخول
        if (Auth::check()) {
            // الحصول على بيانات المستخدم
            $authenticatedUser = Auth::user();

            // البحث عن المستخدم في جدول users باستخدام البريد الإلكتروني
            $user = User::where('email', $authenticatedUser->email)->first();

            // التحقق من صحة البيانات المدخلة
            $validatedData = $request->validate([
                'booking_date' => 'required|date',
                'agency' => 'required|array',
                'second_product' => 'required|string',
                'additional' => 'required|string',
                'fav_sauce' => 'nullable|array',
                'total_price' => 'required|numeric',
                'productName' => 'required|string|max:255',
            ]);

            // الحصول على آخر رقم تم تخزينه في قاعدة البيانات وزيادته بمقدار 1
            $lastOrder = DB::table('booking_request')->max('order_id');
            $newOrderId = $lastOrder ? $lastOrder + 1 : 1; // إذا لم يكن هناك قيمة سابقة يبدأ من 1

            // جمع البيانات من النموذج
            $bookingRequest = new BookingRequest();
            $bookingRequest->order_id = $newOrderId;  // تعيين الرقم الجديد
            $bookingRequest->agency = implode(', ', $validatedData['agency']);
            $bookingRequest->second_product = $validatedData['second_product'];
            $bookingRequest->additional = $validatedData['additional'];
            $bookingRequest->fav_sauce = implode(', ', $validatedData['fav_sauce'] ?? []);
            $bookingRequest->total_price = $validatedData['total_price'];
            $bookingRequest->customer_name = $user->full_name;  // اسم العميل من بيانات المستخدم
            $bookingRequest->customer_email = $user->email;
            $bookingRequest->customer_phone = $user->phone_number;
            $bookingRequest->customer_address = $user->address;
            $bookingRequest->status = 'pending';
            $bookingRequest->booking_date = $validatedData['booking_date'];
            $bookingRequest->main_product = $validatedData['productName']; // تخزين اسم المنتج
            // حفظ البيانات في قاعدة البيانات
            $bookingRequest->save();

            // إضافة المنتج إلى السلة باستخدام مكتبة CartFacade
            Cart::add([
                'id' => $newOrderId,  // أو أي معرّف مناسب
                'name' => $validatedData['productName'],
                'price' => $validatedData['total_price'],
                'quantity' => 1,  // إضافة منتج واحد
                'attributes' => [
                    'booking_date' => $validatedData['booking_date'],
                    'agency' => implode(', ', $validatedData['agency']),
                ],
            ]);

            // إعادة التوجيه إلى صفحة الهوم مع رسالة نجاح
            return redirect()->route('home')->with('message', 'تم الحجز بنجاح وتم إضافة المنتج إلى السلة');
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
