<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{{ $tieu_de }}</title>
</head>
<body>
    <h2>{{ $tieu_de }}</h2>
    <div style="font-size: 1.1rem; color: #333;">
        {!! nl2br(e($noi_dung)) !!}
    </div>
    <hr>
    <p style="font-size: 0.9rem; color: #888;">Đây là email tự động từ hệ thống quản lý nhân sự.</p>
</body>
</html> 