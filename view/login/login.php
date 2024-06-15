<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <title>Tiêu đề của bạn</title>
</head>

<body>
    <div class="container" id="container">

        <div class="form-container sign-in-container">
            <form id="loginForm" action="index.php?controller=login&act=do-login" method="post" onsubmit="return validateForm()">
                <h1>Đăng nhập</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn</span>
                <input type="email" id="email" name="email" placeholder="Email" />
                <input type="password" id="password" name="password" placeholder="Mật khẩu" />
                <a href="index.php?controller=quenMatKhau">Quên mật khẩu?</a>

                <!-- Hiển thị thông báo lỗi nếu đăng nhập thất bại -->
                <button type="submit">Đăng nhập</button>
                <a href="index.php?controller=login&act=signup">Đăng ký</a>

            </form>
            <div>
                <img src="assets/imgs/item/1.jpg" alt="loi">
            </div>
        </div>

    </div>

    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (email.trim() === '' || password.trim() === '') {
                alert('Vui lòng điền đầy đủ thông tin.');
                return false; // Ngăn chặn việc gửi form
            }

            // Bạn có thể thêm logic kiểm tra phức tạp hơn nếu cần

            return true; // Cho phép gửi form
        }
    </script>
</body>

</html>
