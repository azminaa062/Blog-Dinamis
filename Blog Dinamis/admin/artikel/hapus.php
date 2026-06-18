<?php
include '../../helpers/auth.php';
check_admin();
include '../../config/koneksi.php';

$id = (int)$_GET['id'];
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM article_tags WHERE article_id='$id'");
    mysqli_query($conn, "DELETE FROM comments WHERE article_id='$id'");
    mysqli_query($conn, "DELETE FROM articles WHERE id='$id'");
}
header("Location: index.php");
exit;
