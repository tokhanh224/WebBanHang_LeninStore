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
            <form id="signupForm" action="index.php?controller=login&act=do-signup" method="post"
                onsubmit="return validateForm()">
                <h1>Đăng ký</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input type="email" id="email" name="email" placeholder="Email" />
                <input type="password" id="password" name="password" placeholder="Mật khẩu" />
                <input type="text" id="address" name="address" placeholder="Địa chỉ" />
                <input type="tel" id="tel" name="tel" placeholder="Số điện thoại" />
                <button type="submit">Đăng ký</button>
                <a href="index.php?controller=login&act=login">Đăng nhập</a>
            </form>
        </div>
        
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var address = document.getElementById('address').value;
            var tel = document.getElementById('tel').value;

            if (email.trim() === '' || password.trim() === '' || address.trim() === '' || tel.trim() === '') {
                alert('Vui lòng điền đầy đủ thông tin.');
                return false;
            }

            // Kiểm tra số điện thoại có đúng định dạng không (ít nhất 10 chữ số)
            var telPattern = /^\d{10,}$/;
            if (!telPattern.test(tel)) {
                alert('Số điện thoại không đúng định dạng.');
                return false;
            }

            return true;
        }

    </script>
</body>

</html>