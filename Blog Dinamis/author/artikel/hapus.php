<?php
include '../../helpers/auth.php';
check_author();
include '../../config/koneksi.php';

$id      = (int)$_GET['id'];
$user_id = (int)$_SESSION['user_id'];
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM article_tags WHERE article_id='$id'");
    mysqli_query($conn, "DELETE FROM comments WHERE article_id='$id'");
    mysqli_query($conn, "DELETE FROM articles WHERE id='$id' AND user_id='$user_id'");
}
header("Location: index.php");
exit;
