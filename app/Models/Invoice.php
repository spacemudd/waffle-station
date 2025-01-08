<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'invoice_number', 'customer_id', 'user_id', 'total_amount', 'issue_date', 'due_date', 'status'
    ];

    // العلاقة مع جدول المستخدمين (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    // يمكنك إضافة أي دوال أخرى لتحسين الفاتورة مثل حساب المبلغ بعد الخصم أو غيرها
    public function getTotalAmountWithTax()
    {
        $taxRate = 0.15; // نسبة الضريبة (على سبيل المثال 15%)
        return $this->total_amount * (1 + $taxRate);
    }

    // يمكنك إضافة دوال لتغيير الحالة
    public function markAsPaid()
    {
        $this->status = 'paid';
        $this->save();
    }

    public function markAsUnpaid()
    {
        $this->status = 'unpaid';
        $this->save();
    }

    public function markAsOverdue()
    {
        $this->status = 'overdue';
        $this->save();
    }

    // إذا كنت بحاجة إلى تقديم الحقول بتنسيق معين مثل التاريخ، يمكنك استخدام Accessors
    public function getIssueDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function getDueDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
