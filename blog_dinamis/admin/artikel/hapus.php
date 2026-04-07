<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM articles WHERE id='$id'");
header("Location: index.php");
exit;
?>