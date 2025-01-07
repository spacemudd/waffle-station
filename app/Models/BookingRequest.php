<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    use HasFactory;

    // تحديد اسم الجدول في قاعدة البيانات
    protected $table = 'booking_request';

    // تحديد الأعمدة القابلة للتعبئة (Mass Assignment)
    protected $fillable = [
        'order_id',
        'agency',
        'main_product',
        'second_product',
        'additional',
        'fav_sauce',
        'total_price',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'status',
        'booking_date',
    ];

    // إذا كنت ترغب في إضافة أي علاقة بين الجداول (مثل علاقة مع جدول آخر)
    // يمكن إضافة دوال لعلاقات مثل:
    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
}
