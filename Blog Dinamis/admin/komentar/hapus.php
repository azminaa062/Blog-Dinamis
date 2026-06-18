<?php
include '../../helpers/auth.php';
check_admin();
include '../../config/koneksi.php';

$id = (int)$_GET['id'];
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM comments WHERE id='$id'");
}
header("Location: index.php");
exit;
