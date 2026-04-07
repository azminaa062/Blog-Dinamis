<?php
include '../../config/koneksi.php';
include '../../helpers/function.php';

$id          = $_POST['id'];
$category_id = $_POST['category_id'];
$judul       = trim($_POST['judul']);
$slug        = slugify($judul);
$ringkasan   = trim($_POST['ringkasan']);
$isi         = trim($_POST['isi']);
$status      = $_POST['status'];

$thumbnail_sql = "";

if (!empty($_FILES['thumbnail']['name'])) {
    $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
    $tmp       = $_FILES['thumbnail']['tmp_name'];
    $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed   = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) {
        die("Format file thumbnail tidak valid.");
    }

    move_uploaded_file($tmp, "../../assets/uploads/thumbnail/" . $file_name);
    $thumbnail_sql = ", thumbnail='$file_name'";
}

if ($status == 'publish') {
    mysqli_query($conn, "UPDATE articles SET
        category_id='$category_id',
        judul='$judul',
        slug='$slug',
        ringkasan='$ringkasan',
        isi='$isi',
        status='$status',
        published_at=NOW()
        $thumbnail_sql
        WHERE id='$id'");
} else {
    mysqli_query($conn, "UPDATE articles SET
        category_id='$category_id',
        judul='$judul',
        slug='$slug',
        ringkasan='$ringkasan',
        isi='$isi',
        status='$status'
        $thumbnail_sql
        WHERE id='$id'");
}

mysqli_query($conn, "DELETE FROM article_tags WHERE article_id='$id'");

if (!empty($_POST['tags'])) {
    foreach ($_POST['tags'] as $tag_id) {
        mysqli_query($conn, "INSERT INTO article_tags (article_id, tag_id)
        VALUES ('$id', '$tag_id')");
    }
}

header("Location: index.php");
exit;
?>