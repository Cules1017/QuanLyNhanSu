<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'tieu_de', 'noi_dung', 'loai', 'nguoi_gui_id'
    ];

    public function targets()
    {
        return $this->hasMany(NotificationTarget::class, 'notification_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'nguoi_gui_id');
    }
}
