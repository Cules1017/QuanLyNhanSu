<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_id', 'ma_nhan_vien', 'da_xem', 'da_gui_mail'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien');
    }
}
