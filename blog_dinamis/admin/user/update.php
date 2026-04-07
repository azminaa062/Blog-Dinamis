<?php
include '../../config/koneksi.php';

$id       = $_POST['id'];
$nama     = trim($_POST['nama']);
$username = trim($_POST['username']);
$role     = $_POST['role'];
$bio      = trim($_POST['bio']);
$password = trim($_POST['password']);

if ($password != '') {
    $password = md5($password);
    mysqli_query($conn, "UPDATE users SET
        nama='$nama',
        username='$username',
        password='$password',
        role='$role',
        bio='$bio'
        WHERE id='$id'");
} else {
    mysqli_query($conn, "UPDATE users SET
        nama='$nama',
        username='$username',
        role='$role',
        bio='$bio'
        WHERE id='$id'");
}

header("Location: index.php");
exit;
?>