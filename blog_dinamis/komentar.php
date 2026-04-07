<?php
include 'config/koneksi.php';

$article_id    = $_POST['article_id'];
$nama          = trim($_POST['nama']);
$email         = trim($_POST['email']);
$isi_komentar  = trim($_POST['isi_komentar']);

mysqli_query($conn, "INSERT INTO comments (article_id, nama, email, isi_komentar, status)
VALUES ('$article_id', '$nama', '$email', '$isi_komentar', 'pending')");

echo "<script>alert('Komentar berhasil dikirim dan menunggu persetujuan admin.'); history.back();</script>";
?>