<?php
include '../../config/koneksi.php';

$nama     = trim($_POST['nama']);
$username = trim($_POST['username']);
$password = md5($_POST['password']);
$role     = $_POST['role'];
$bio      = trim($_POST['bio']);

mysqli_query($conn, "INSERT INTO users (nama, username, password, role, bio)
VALUES ('$nama', '$username', '$password', '$role', '$bio')");

header("Location: index.php");
exit;
?>