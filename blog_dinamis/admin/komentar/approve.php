<?php
include '../../config/koneksi.php';
$id = $_GET['id'];

mysqli_query($conn, "UPDATE comments SET status='approved' WHERE id='$id'");
header("Location: index.php");
exit;
?>