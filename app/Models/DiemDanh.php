<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemDanh extends Model
{
    use HasFactory;

    protected $table = 'diem_danh';
    protected $fillable = [
        'ma_nhan_vien',
        'ngay',
        'gio_vao',
        'gio_ra',
        'trang_thai'
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }
} 