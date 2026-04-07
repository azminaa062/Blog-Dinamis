<?php
session_start();
include '../../config/koneksi.php';
include '../../helpers/function.php';

$user_id     = $_SESSION['user_id'];
$category_id = $_POST['category_id'];
$judul       = trim($_POST['judul']);
$slug        = slugify($judul);
$ringkasan   = trim($_POST['ringkasan']);
$isi         = trim($_POST['isi']);
$status      = $_POST['status'];

$published_at = ($status == 'publish') ? date('Y-m-d H:i:s') : NULL;

if ($published_at) {
    mysqli_query($conn, "INSERT INTO articles (user_id, category_id, judul, slug, ringkasan, isi, status, published_at)
    VALUES ('$user_id', '$category_id', '$judul', '$slug', '$ringkasan', '$isi', '$status', '$published_at')");
} else {
    mysqli_query($conn, "INSERT INTO articles (user_id, category_id, judul, slug, ringkasan, isi, status)
    VALUES ('$user_id', '$category_id', '$judul', '$slug', '$ringkasan', '$isi', '$status')");
}

header("Location: index.php");
exit;
?>