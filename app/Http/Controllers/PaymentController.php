<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function showNoonPayment()
    {
        return view('front.payments.noon');
    }

    public function processPayment(Request $request)
    {

        $validatedData = session('validatedData');
        // بيانات البطاقة المسجلة في الكود
        $testCard = [
            'card_number' => '1234567890123456',
            'expiry_month' => '12',
            'expiry_year' => '2025',
            'cvv' => '123',
            'cardholder_name' => 'John Doe'
        ];

        // التحقق من البيانات المدخلة
        if (
            $request->card_number === $testCard['card_number'] &&
            $request->expiry_month === $testCard['expiry_month'] &&
            $request->expiry_year === $testCard['expiry_year'] &&
            $request->cvv === $testCard['cvv'] &&
            $request->cardholder_name === $testCard['cardholder_name']
        ) {
            // إذا تم الدفع بنجاح، إنشاء الفاتورة
            $invoice = Invoice::create([
                'invoice_number' => 'INV-' . time(),  // يمكن توليد رقم فاتورة فريد بناءً على الوقت
                'user_id' => auth()->id(),  // تحديد المستخدم الحالي الذي قام بالدفع
                'total_amount' => $validatedData['total_price'],  // المبلغ الإجمالي من الطلب
                'issue_date' => now(),  // تاريخ الإصدار
                'due_date' => now()->addDays(30),  // تاريخ الاستحقاق (على سبيل المثال 30 يومًا من الآن)
                'status' => 'paid',  // تم الدفع
            ]);


            // إرجاع رسالة نجاح مع الفاتورة
            return redirect('/')
                ->with('success', 'Thank you for your purchase! Your invoice number is ' . $invoice->invoice_number);
        }

        // إذا فشل الدفع، إرجاع رسالة فشل
        return redirect()
            ->back()
            ->with('error', 'Payment failed, please check the entered data.');
    }

    
}
