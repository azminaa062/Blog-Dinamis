<?php
include '../../helpers/auth.php';
include '../../config/koneksi.php';
include '../../helpers/function.php';
check_author();

$user_id     = (int)$_SESSION['user_id'];
$category_id = (int)$_POST['category_id'];
$judul       = mysqli_real_escape_string($conn, trim($_POST['judul']));
$slug        = mysqli_real_escape_string($conn, slugify(trim($_POST['judul'])));
$ringkasan   = mysqli_real_escape_string($conn, trim($_POST['ringkasan'] ?? ''));
$isi         = mysqli_real_escape_string($conn, trim($_POST['isi']));
$status      = in_array($_POST['status'], ['publish','draft']) ? $_POST['status'] : 'draft';

$published_at = ($status === 'publish') ? date('Y-m-d H:i:s') : NULL;

// Handle thumbnail upload
$thumbnail = '';
if (!empty($_FILES['thumbnail']['name'])) {
    $upload_dir = '../../assets/uploads/thumbnail/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
    $tmp       = $_FILES['thumbnail']['tmp_name'];
    $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed   = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($ext, $allowed)) {
        move_uploaded_file($tmp, $upload_dir . $file_name);
        $thumbnail = mysqli_real_escape_string($conn, $file_name);
    }
}

if ($published_at) {
    mysqli_query($conn, "INSERT INTO articles (user_id, category_id, judul, slug, ringkasan, isi, status, thumbnail, published_at)
    VALUES ('$user_id', '$category_id', '$judul', '$slug', '$ringkasan', '$isi', '$status', '$thumbnail', '$published_at')");
} else {
    mysqli_query($conn, "INSERT INTO articles (user_id, category_id, judul, slug, ringkasan, isi, status, thumbnail)
    VALUES ('$user_id', '$category_id', '$judul', '$slug', '$ringkasan', '$isi', '$status', '$thumbnail')");
}

$article_id = mysqli_insert_id($conn);

if (!empty($_POST['tags'])) {
    foreach ($_POST['tags'] as $tag_id) {
        $tag_id = (int)$tag_id;
        mysqli_query($conn, "INSERT INTO article_tags (article_id, tag_id) VALUES ('$article_id', '$tag_id')");
    }
}

header("Location: index.php");
exit;
