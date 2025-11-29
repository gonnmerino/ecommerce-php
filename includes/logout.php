<?php
include('session.php');

$_SESSION = array();

session_destroy();

header('Location: ../cuenta.php');
exit();
?>