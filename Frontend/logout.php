<?php
    session_start();

    $_SESSION['user_id'] = "";
    $_SESSION['user_email'] = "";
    $_SESSION['key'] = "";

    header("location: login.php");
?>