<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

function slugify_kat($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

$id            = (int)$_POST['id'];
$nama_kategori = mysqli_real_escape_string($conn, trim($_POST['nama_kategori']));
$slug          = mysqli_real_escape_string($conn, slugify_kat($_POST['nama_kategori']));

mysqli_query($conn, "UPDATE categories SET nama_kategori='$nama_kategori', slug='$slug' WHERE id='$id'");

header("Location: index.php");
exit;
