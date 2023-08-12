<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Không có quyền truy cập</title>
</head>
<body>
    <img src="https://limosa.vn/wp-content/uploads/2022/08/loi-403-Forbidden-tren-dien-thoai-1.png" style="width: 100%;height:100vh;" alt="">
    <div style="position: relative;">
        <a href="{{$data}}" style="position: absolute; top:-100px; font-size:50px; left:40%"> Quay về Trang Chủ</a>
        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
            @csrf
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="position: absolute; top:-100px; font-size:50px; left:60%">Đăng Nhập lại</a>
        </form>
    </div>
</body>
</html>