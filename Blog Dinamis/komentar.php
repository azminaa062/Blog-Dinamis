<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /blog_dinamis/index.php');
    exit;
}

$article_id   = isset($_POST['article_id'])   ? (int)$_POST['article_id']                              : 0;
$nama         = isset($_POST['nama'])         ? mysqli_real_escape_string($conn, trim($_POST['nama']))         : '';
$email        = isset($_POST['email'])        ? mysqli_real_escape_string($conn, trim($_POST['email']))        : '';
$isi_komentar = isset($_POST['isi_komentar']) ? mysqli_real_escape_string($conn, trim($_POST['isi_komentar'])) : '';

if ($article_id <= 0 || $nama === '' || $isi_komentar === '') {
    header('Location: /blog_dinamis/index.php');
    exit;
}

mysqli_query($conn, "
    INSERT INTO comments (article_id, nama, email, isi_komentar, status)
    VALUES ('$article_id', '$nama', '$email', '$isi_komentar', 'pending')
");

// Get article slug to redirect back
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT slug FROM articles WHERE id=$article_id LIMIT 1"));
$back = $row ? '/blog_dinamis/artikel.php?slug=' . urlencode($row['slug']) . '&comment=sent#komentar' : '/blog_dinamis/index.php';

header('Location: ' . $back);
exit;
