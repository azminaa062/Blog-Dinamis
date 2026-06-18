<?php
session_start();
session_unset();
session_destroy();
header("Location: /blog_dinamis/auth/login.php");
exit;
