<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function check_login()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /blog_dinamis/auth/login.php");
        exit;
    }
}

function check_admin()
{
    check_login();
    if ($_SESSION['role'] !== 'admin') {
        header("Location: /blog_dinamis/auth/login.php");
        exit;
    }
}

function check_author()
{
    check_login();
    if ($_SESSION['role'] !== 'author') {
        header("Location: /blog_dinamis/auth/login.php");
        exit;
    }
}
