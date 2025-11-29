<?php
    session_start();
    if (isset($_SESSION['admin'])) {
        $admin = $_SESSION['admin'];
    } else {
        $admin = 0;
        $_SESSION['admin'] = 0;
    }
?>