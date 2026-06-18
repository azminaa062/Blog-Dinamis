<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
check_admin();

function slugify_tag($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

$id       = (int)$_POST['id'];
$nama_tag = mysqli_real_escape_string($conn, trim($_POST['nama_tag']));
$slug     = mysqli_real_escape_string($conn, slugify_tag($_POST['nama_tag']));

mysqli_query($conn, "UPDATE tags SET nama_tag='$nama_tag', slug='$slug' WHERE id='$id'");

header("Location: index.php");
exit;
