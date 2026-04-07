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

$article_id = mysqli_insert_id($conn);

if (!empty($_POST['tags'])) {
    foreach ($_POST['tags'] as $tag_id) {
        mysqli_query($conn, "INSERT INTO article_tags (article_id, tag_id) 
        VALUES ('$article_id', '$tag_id')");
    }
}

header("Location: index.php");
exit;
?>