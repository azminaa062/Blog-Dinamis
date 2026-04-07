<?php
session_start();
include '../../config/koneksi.php';

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM articles WHERE id='$id' AND user_id='$user_id'");
header("Location: index.php");
exit;
?>