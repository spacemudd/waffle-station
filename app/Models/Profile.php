<?php

// app/Models/Profile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // تعريف الجدول المرتبط بالموديل
    protected $table = 'profiles';

    // تعريف الأعمدة القابلة للتعبئة (mass assignable)
    protected $fillable = [
        'user_id',        // المفتاح الأجنبي الذي يربط هذا البروفايل بالمستخدم
        'phone',          // رقم الهاتف
        'address',        // العنوان
        'profile_picture' // الصورة الشخصية
    ];

    // العلاقة بين المستخدم والبروفايل
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
