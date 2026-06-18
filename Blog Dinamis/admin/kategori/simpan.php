<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

function slugify_kat($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

$nama_kategori = mysqli_real_escape_string($conn, trim($_POST['nama_kategori']));
$slug          = mysqli_real_escape_string($conn, slugify_kat($_POST['nama_kategori']));

mysqli_query($conn, "INSERT INTO categories (nama_kategori, slug) VALUES ('$nama_kategori', '$slug')");

header("Location: index.php");
exit;
