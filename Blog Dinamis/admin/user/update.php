<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

$id       = (int)$_POST['id'];
$nama     = mysqli_real_escape_string($conn, trim($_POST['nama']));
$username = mysqli_real_escape_string($conn, trim($_POST['username']));
$role     = in_array($_POST['role'], ['admin','author']) ? $_POST['role'] : 'author';
$bio      = mysqli_real_escape_string($conn, trim($_POST['bio'] ?? ''));
$password = trim($_POST['password'] ?? '');

if ($password !== '') {
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
