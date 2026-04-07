<?php
session_start();
include '../config/koneksi.php';


$username = trim($_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");

$user = mysqli_fetch_assoc($query);

if ($user) {
    $_SESSION['user_id']  = $user['id'];
    $_SESSION['nama']     = $user['nama'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role']     = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../author/dashboard.php");
    }
    exit;
} else {
    echo "<script>alert('Login gagal! Username atau password salah.'); window.location='login.php';</script>";
}
?>