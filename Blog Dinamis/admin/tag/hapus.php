<?php
include '../../helpers/auth.php';
check_admin();
include '../../config/koneksi.php';

$id = (int)$_GET['id'];
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM article_tags WHERE tag_id='$id'");
    mysqli_query($conn, "DELETE FROM tags WHERE id='$id'");
}
header("Location: index.php");
exit;
