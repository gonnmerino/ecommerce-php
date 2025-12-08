<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';

$nuevaPagConfig = trim($_POST['pagNumberCfg']);

$sql_pag = "UPDATE cfg_panel SET por_pagina = ?";
$stmt = $conn->prepare($sql_pag);
$stmt->bind_param("i", $nuevaPagConfig);

  if($stmt ->execute()) {
    Header('Location:' . ADMIN_URL . 'admin-panel.php');
  } else {
    echo 'error';
  }
?>

