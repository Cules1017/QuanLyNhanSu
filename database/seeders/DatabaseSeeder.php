<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nguoi_quan_tri')->insert([
            'ten_dang_nhap' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret')
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 55,
            'ten_phong_ban' => 'Tài Chính',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 56,
            'ten_phong_ban' => 'Kế Hoạch',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 57,
            'ten_phong_ban' => 'Kinh Doanh',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 60,
            'ten_vi_tri' => 'Nhân Viên',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 61,
            'ten_vi_tri' => 'Trưởng Phòng',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 62,
            'ten_vi_tri' => 'Giám Đốc',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 62,
            'ten' => 'An',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'nv@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien')
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 63,
            'ten' => 'Anh',
            'ho'=>'Trần Hà',
            'cccd'=>'00292327329',
            'email'=>'nv@gmail.com',
            'ma_vi_tri'=>61,
            'ma_phong_ban'=>56,
            'password'=>bcrypt('nhanvien')
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 64,
            'ten' => 'KONH',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'nv@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>56,
            'password'=>bcrypt('nhanvien')
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 65,
            'ten' => 'nhanvien',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'nv@gmail.com',
            'ma_vi_tri'=>62,
            'ma_phong_ban'=>57,
            'password'=>bcrypt('nhanvien')
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 66,
            'ten' => 'Quanh',
            'ho'=>'Nguyễn',
            'cccd'=>'00292327329',
            'email'=>'nv@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien')
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 67,
            'ten' => 'La nhan vien',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'nv@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien')
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 62,
            'tien_luong' => 10000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 63,
            'tien_luong' => 20000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 64,
            'tien_luong' => 10000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 65,
            'tien_luong' => 50000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 66,
            'tien_luong' => 30000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 67,
            'tien_luong' => 40000,
        ]);
    }
}
