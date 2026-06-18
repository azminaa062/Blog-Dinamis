<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
include '../../helpers/function.php';
check_admin();

$id          = (int)$_POST['id'];
$category_id = (int)$_POST['category_id'];
$judul       = mysqli_real_escape_string($conn, trim($_POST['judul']));
$slug        = mysqli_real_escape_string($conn, slugify(trim($_POST['judul'])));
$ringkasan   = mysqli_real_escape_string($conn, trim($_POST['ringkasan'] ?? ''));
$isi         = mysqli_real_escape_string($conn, trim($_POST['isi']));
$status      = in_array($_POST['status'], ['publish','draft']) ? $_POST['status'] : 'draft';

$thumbnail_sql = "";

if (!empty($_FILES['thumbnail']['name'])) {
    $upload_dir = '../../assets/uploads/thumbnail/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
    $tmp       = $_FILES['thumbnail']['tmp_name'];
    $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed   = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ext, $allowed)) {
        header("Location: edit.php?id=$id&error=invalid_file");
        exit;
    }

    move_uploaded_file($tmp, $upload_dir . $file_name);
    $file_name_escaped = mysqli_real_escape_string($conn, $file_name);
    $thumbnail_sql = ", thumbnail='$file_name_escaped'";
}

if ($status === 'publish') {
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
        status='$status',
        published_at=NULL
        $thumbnail_sql
        WHERE id='$id'");
}

mysqli_query($conn, "DELETE FROM article_tags WHERE article_id='$id'");

if (!empty($_POST['tags'])) {
    foreach ($_POST['tags'] as $tag_id) {
        $tag_id = (int)$tag_id;
        mysqli_query($conn, "INSERT INTO article_tags (article_id, tag_id) VALUES ('$id', '$tag_id')");
    }
}

header("Location: index.php");
exit;
