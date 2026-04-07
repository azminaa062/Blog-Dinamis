<?php
include '../../config/koneksi.php';
include '../../helpers/function.php';

$nama = trim($_POST['nama_tag']);
$slug = slugify($nama);

mysqli_query($conn, "INSERT INTO tags (nama_tag, slug) VALUES ('$nama', '$slug')");
header("Location: index.php");
exit;
?>