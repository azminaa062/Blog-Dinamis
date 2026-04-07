<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../author/dashboard.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Blog Dinamis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Login Blog Dinamis</h3>

                    <form action="proses_login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye" id="iconPassword"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
    <label class="form-label">Captcha</label>

    <div class="d-flex align-items-center gap-2 mb-2">
        <img src="captcha.php" id="captchaImage" class="border rounded">

        <button type="button" class="btn btn-outline-secondary" onclick="refreshCaptcha()">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>

    <input type="text" name="captcha_input" class="form-control" placeholder="Masukkan huruf di atas" required>
</div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="mt-3 text-muted small">
                        <div>Admin: <b>admin</b> / <b>admin123</b></div>
                        <div>Author: <b>author</b> / <b>author123</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');
const iconPassword = document.getElementById('iconPassword');

togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    if (type === 'text') {
        iconPassword.classList.remove('bi-eye');
        iconPassword.classList.add('bi-eye-slash');
    } else {
        iconPassword.classList.remove('bi-eye-slash');
        iconPassword.classList.add('bi-eye');
    }
});
</script>
<script>
function refreshCaptcha() {
    document.getElementById('captchaImage').src = 'captcha.php?' + Date.now();
}
</script>
</body>
</html> 