<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';

$_SESSION = array();

session_destroy();

header('Location:' . INCLUDES_URL . 'login_usuario.php');
exit();
?>