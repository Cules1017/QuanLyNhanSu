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
        DB::table('nguoi_quan_tri')->insert([
            'ten_dang_nhap' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nguoi_quan_tri')->insert([
            'ten_dang_nhap' => 'supervisor',
            'email' => 'supervisor@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nguoi_quan_tri')->insert([
            'ten_dang_nhap' => 'director',
            'email' => 'director@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nguoi_quan_tri')->insert([
            'ten_dang_nhap' => 'assistant',
            'email' => 'assistant@gmail.com',
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
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 58,
            'ten_phong_ban' => 'Nhân Sự',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 59,
            'ten_phong_ban' => 'Công Nghệ',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 60,
            'ten_phong_ban' => 'Marketing',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('phong_ban')->insert([
            'ma_phong_ban' => 61,
            'ten_phong_ban' => 'Pháp Chế',
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
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 63,
            'ten_vi_tri' => 'Phó Giám Đốc',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 64,
            'ten_vi_tri' => 'Thực Tập Sinh',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 65,
            'ten_vi_tri' => 'Chuyên Viên',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('vi_tri')->insert([
            'ma_vi_tri' => 66,
            'ten_vi_tri' => 'Trợ Lý',
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 62,
            'ten' => 'An',
            'ho'=>'Trần',
            'cccd'=>'00292327329',
            'email'=>'tranan@gmail.com',
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '1990-01-15',
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
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '1992-05-20',
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
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '1988-11-30',
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
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '1995-03-25',
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
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '1991-07-10',
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
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '1989-09-15',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>55,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 68,
            'ten' => 'Minh',
            'ho'=>'Lê',
            'cccd'=>'00292327330',
            'email'=>'leminh@gmail.com',
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '1993-04-20',
            'ma_vi_tri'=>63,
            'ma_phong_ban'=>58,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 69,
            'ten' => 'Hương',
            'ho'=>'Phạm',
            'cccd'=>'00292327331',
            'email'=>'phamhuong@gmail.com',
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '1994-06-25',
            'ma_vi_tri'=>64,
            'ma_phong_ban'=>59,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 70,
            'ten' => 'Dũng',
            'ho'=>'Vũ',
            'cccd'=>'00292327332',
            'email'=>'vudung@gmail.com',
            'gioi_tinh' => 'Nam',
            'ngay_sinh' => '1992-08-30',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>59,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 71,
            'ten' => 'Hà',
            'ho'=>'Nguyễn',
            'cccd'=>'00292327333',
            'email'=>'nguyenha@gmail.com',
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '1996-02-15',
            'ma_vi_tri'=>65,
            'ma_phong_ban'=>60,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 72,
            'ten' => 'Linh',
            'ho'=>'Trần',
            'cccd'=>'00292327334',
            'email'=>'tranlinh@gmail.com',
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '1993-12-10',
            'ma_vi_tri'=>66,
            'ma_phong_ban'=>61,
            'password'=>bcrypt('nhanvien'),
            'created_at' => '2023-08-13 10:45:23',
            'updated_at' => '2023-08-13 10:45:23',
        ]);
        DB::table('nhan_vien')->insert([
            'ma_nhan_vien' => 73,
            'ten' => 'Phương',
            'ho'=>'Lê',
            'cccd'=>'00292327335',
            'email'=>'lephuong@gmail.com',
            'gioi_tinh' => 'Nữ',
            'ngay_sinh' => '1995-10-05',
            'ma_vi_tri'=>60,
            'ma_phong_ban'=>60,
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
        DB::table('luong')->insert([
            'ma_nhan_vien' => 68,
            'tien_luong' => 45000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 69,
            'tien_luong' => 15000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 70,
            'tien_luong' => 25000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 71,
            'tien_luong' => 35000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 72,
            'tien_luong' => 28000,
        ]);
        DB::table('luong')->insert([
            'ma_nhan_vien' => 73,
            'tien_luong' => 22000,
        ]);
    }
}
