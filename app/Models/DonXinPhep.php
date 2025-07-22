<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonXinPhep extends Model
{
    use HasFactory;
    protected $table = 'don_xin_phep';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'ma_nhan_vien', 'ma_nhan_vien');
    }
} 