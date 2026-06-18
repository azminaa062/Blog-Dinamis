<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

function slugify_tag($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

$nama_tag = mysqli_real_escape_string($conn, trim($_POST['nama_tag']));
$slug     = mysqli_real_escape_string($conn, slugify_tag($_POST['nama_tag']));

mysqli_query($conn, "INSERT INTO tags (nama_tag, slug) VALUES ('$nama_tag', '$slug')");

header("Location: index.php");
exit;
