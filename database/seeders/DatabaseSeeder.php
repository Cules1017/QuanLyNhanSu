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
            'password' => bcrypt('secret'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 55,
            'ten_phong_ban' => 'Tài Chính',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 56,
            'ten_phong_ban' => 'Kế Hoạch',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 57,
            'ten_phong_ban' => 'Kinh Doanh',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 60,
            'ten_vi_tri' => 'Nhân Viên',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 61,
            'ten_vi_tri' => 'Trưởng Phòng',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 62,
            'ten_vi_tri' => 'Giám Đốc',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 62,
            'ten' => 'An',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'tranan@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 63,
            'ten' => 'Anh',
            'ho'=>'Trần Hà',
            'cccd'=>'00292327329',
            'email'=>'haanh2810@gmail.com',
            'ma_vi_tri'=>61,
            'ma_phong_ban'=>56,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 64,
            'ten' => 'Văn Nam',
            'ho'=>'Nguyễn',
            'cccd'=>'00292327329',
            'email'=>'vannam26251@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>56,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 65,
            'ten' => 'Ngọc Hà',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'ngochatran@gmail.com',
            'ma_vi_tri'=>62,
            'ma_phong_ban'=>57,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 66,
            'ten' => 'Quanh',
            'ho'=>'Nguyễn',
            'cccd'=>'00292327329',
            'email'=>'nguyenas182@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 67,
            'ten' => 'Tuấn',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'tuantran@gmail.com',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
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
