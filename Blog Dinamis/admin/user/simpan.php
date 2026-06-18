<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$nama     = mysqli_real_escape_string($conn, trim($_POST['nama']));
$username = mysqli_real_escape_string($conn, trim($_POST['username']));
$password = md5($_POST['password']);
$role     = in_array($_POST['role'], ['admin','author']) ? $_POST['role'] : 'author';
$bio      = mysqli_real_escape_string($conn, trim($_POST['bio'] ?? ''));

// Cek username sudah ada
$cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username='$username' LIMIT 1"));
if ($cek) {
    header("Location: tambah.php?error=username_exists");
    exit;
}

mysqli_query($conn, "INSERT INTO users (nama, username, password, role, bio)
VALUES ('$nama', '$username', '$password', '$role', '$bio')");

header("Location: index.php");
exit;
