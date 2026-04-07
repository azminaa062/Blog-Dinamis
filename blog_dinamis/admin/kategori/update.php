<?php
include '../../config/koneksi.php';
include '../../helpers/function.php';

$id   = $_POST['id'];
$nama = trim($_POST['nama_kategori']);
$slug = slugify($nama);

mysqli_query($conn, "UPDATE categories SET nama_kategori='$nama', slug='$slug' WHERE id='$id'");
header("Location: index.php");
exit;
?>