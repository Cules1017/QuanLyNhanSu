<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NhanVien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'nhan_vien';
    protected $primaryKey = 'ma_nhan_vien';
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function phongBan()
    {
        return $this->belongsTo(\App\Models\PhongBan::class, 'ma_phong_ban');
    }
    public function viTri()
    {
        return $this->belongsTo(\App\Models\Vitri::class, 'ma_vi_tri');
    }
}
