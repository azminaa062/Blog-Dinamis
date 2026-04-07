<?php
include '../../config/koneksi.php';
include '../../helpers/function.php';

$nama = trim($_POST['nama_kategori']);
$slug = slugify($nama);

mysqli_query($conn, "INSERT INTO categories (nama_kategori, slug) VALUES ('$nama', '$slug')");
header("Location: index.php");
exit;
?>