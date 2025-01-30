<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeBugLab\NoonPayment\NoonPayment;
use App\Models\Invoice;


class NoonPaymentController extends Controller
{

    public function index()
    {
        $response = NoonPayment::getInstance()->initiate([
            "order" => [
                "reference" => "1",
                "amount" => "10",
                "currency" => "SAR",
                "name" => "Sample order name",
            ],
            "configuration" => [
                "locale" => "en"
            ]
        ]);

        if ($response->resultCode == 0) {
            return redirect($response->result->checkoutData->postUrl);
        }

        return $response->message;
    }

    public function response(Request $request)
    {
        $response = NoonPayment::getInstance()->getOrder($request->orderId);
        $validatedData=session('validatedData');

    
        if ($this->isSaleTransactionSuccess($response)) {
            // إنشاء الفاتورة
            $invoice = Invoice::create([
                'main_product' => $validatedData['productName'], // يمكنك جلبها من الطلب
                'second_product' => $validatedData['second_product'],
                'booking_date' => $validatedData['booking_date'],
                'request_date' => $validatedData['booking_date'],
                'additional' => $validatedData['additional'],
                'fave_sauce' => is_array($validatedData['fav_sauce']) ? implode(', ', $validatedData['fav_sauce']) : $validatedData['fav_sauce'],                'total_price' => $validatedData['total_price'],
                'user_id' => auth()->id(), // تأكد من أن المستخدم مسجل
            ]);
    
            // إرسال رسالة نجاح مع رقم الفاتورة
            return redirect()->route('home')->with('success', 'Payment completed successfully! Invoice number: ' . $invoice->id);
        }
    
        return redirect()->route('home')->with('error', 'تم إلغاء العملية.');
    }

    private function isSaleTransactionSuccess($response)
{
    return isset($response->result->transactions) &&
        is_array($response->result->transactions) &&
        $response->result->transactions[0]->type == "SALE" &&
        $response->result->transactions[0]->status == "SUCCESS";
}

    
    
}
