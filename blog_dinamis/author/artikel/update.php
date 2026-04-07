<?php
session_start();
include '../../config/koneksi.php';
include '../../helpers/function.php';

$user_id     = $_SESSION['user_id'];
$id          = $_POST['id'];
$category_id = $_POST['category_id'];
$judul       = trim($_POST['judul']);
$slug        = slugify($judul);
$ringkasan   = trim($_POST['ringkasan']);
$isi         = trim($_POST['isi']);
$status      = $_POST['status'];

if ($status == 'publish') {
    mysqli_query($conn, "UPDATE articles SET
        category_id='$category_id',
        judul='$judul',
        slug='$slug',
        ringkasan='$ringkasan',
        isi='$isi',
        status='$status',
        published_at=NOW()
        WHERE id='$id' AND user_id='$user_id'");
} else {
    mysqli_query($conn, "UPDATE articles SET
        category_id='$category_id',
        judul='$judul',
        slug='$slug',
        ringkasan='$ringkasan',
        isi='$isi',
        status='$status'
        WHERE id='$id' AND user_id='$user_id'");
}

header("Location: index.php");
exit;
?>