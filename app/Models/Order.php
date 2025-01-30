<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_product',
        'second_product',
        'booking_date',
        'request_date',
        'additional',
        'fav_sauce',
        'total_price',
        'user_id',
    ];

    // إذا كنت تريد إضافة علاقة بالمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
