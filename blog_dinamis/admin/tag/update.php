<?php
include '../../config/koneksi.php';
include '../../helpers/function.php';

$id   = $_POST['id'];
$nama = trim($_POST['nama_tag']);
$slug = slugify($nama);

mysqli_query($conn, "UPDATE tags SET nama_tag='$nama', slug='$slug' WHERE id='$id'");
header("Location: index.php");
exit;
?>