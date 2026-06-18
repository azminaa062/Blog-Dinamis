<?php
session_start();
include '../config/koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = md5($_POST['password'] ?? '');
$captcha  = trim($_POST['captcha'] ?? '');

// Validasi captcha
if (!isset($_SESSION['captcha']) || strtolower($captcha) !== strtolower($_SESSION['captcha'])) {
    echo "captcha_error";
    exit;
}

// Reset captcha setelah dipakai
unset($_SESSION['captcha']);

$username_escaped = mysqli_real_escape_string($conn, $username);
$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username_escaped' AND password = '$password' LIMIT 1");
$user  = mysqli_fetch_assoc($query);

if ($user) {
    $_SESSION['user_id']  = $user['id'];
    $_SESSION['nama']     = $user['nama'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role']     = $user['role'];

    if ($user['role'] === 'admin') {
        echo "redirect:../admin/dashboard.php";
    } else {
        echo "redirect:../author/dashboard.php";
    }
} else {
    echo "login_failed";
}
exit;
