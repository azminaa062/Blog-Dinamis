<?php
include '../../helpers/auth.php';
check_admin();
include '../../config/koneksi.php';

$id = (int)$_GET['id'];
if ($id > 0 && $id !== (int)$_SESSION['user_id']) {
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
}
header("Location: index.php");
exit;
