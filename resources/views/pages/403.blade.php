<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Không có quyền truy cập - 403 Forbidden</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .error-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            max-width: 500px;
            width: 90%;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon {
            font-size: 6rem;
            color: #e74c3c;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .error-code {
            font-size: 4rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .error-title {
            font-size: 1.8rem;
            color: #34495e;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .error-message {
            font-size: 1.1rem;
            color: #7f8c8d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 140px;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 87, 108, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .decoration {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            animation: float 6s ease-in-out infinite;
        }

        .decoration:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .decoration:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .decoration:nth-child(3) {
            bottom: 10%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 2rem;
                margin: 1rem;
            }

            .error-code {
                font-size: 3rem;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .error-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 250px;
            }
        }

        .lock-icon {
            font-size: 2rem;
            color: #95a5a6;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Decorative elements -->
    <div class="decoration"></div>
    <div class="decoration"></div>
    <div class="decoration"></div>

    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <div class="error-code">403</div>
        
        <div class="error-title">Không có quyền truy cập</div>
        
        <div class="lock-icon">
            <i class="fas fa-lock"></i>
        </div>
        
        <div class="error-message">
            Xin lỗi, bạn không có quyền truy cập vào trang này. 
            Vui lòng đăng nhập với tài khoản có quyền phù hợp hoặc liên hệ quản trị viên.
        </div>
        
        <div class="error-actions">
            <a href="{{ $data ?? '/' }}" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Trang Chủ
            </a>
            
            <form role="form" method="post" action="{{ route('logout') }}" id="logout-form" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="btn btn-secondary">
                    <i class="fas fa-sign-in-alt"></i>
                    Đăng Nhập Lại
                </a>
            </form>
        </div>
    </div>
</body>
</html>