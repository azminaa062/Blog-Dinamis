<?php
include '../../helpers/auth.php';
check_admin();
include '../../config/koneksi.php';

$id = (int)$_GET['id'];
if ($id > 0) {
    mysqli_query($conn, "UPDATE comments SET status='rejected' WHERE id='$id'");
}
header("Location: index.php");
exit;
