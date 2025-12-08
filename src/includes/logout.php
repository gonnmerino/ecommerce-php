<?php
require_once __DIR__ . '/../../config.php';
include INCLUDES_PATH . 'conexion.php';
include INCLUDES_PATH . 'session.php';

$_SESSION = array();

session_destroy();

header('Location:' . BASE_URL . 'cuenta.php');
exit();
?>