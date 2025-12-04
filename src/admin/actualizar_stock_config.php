<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';

$nuevaStockConfig = trim($_POST['stockNumberCfg']);

$sql_stock = "UPDATE cfg_panel SET stock_bajo_numero = ?";
$stmt = $conn->prepare($sql_stock);
$stmt->bind_param("i", $nuevaStockConfig);

  if($stmt ->execute()) {
    Header('Location:' . ADMIN_URL . 'admin-panel.php');
  } else {
    echo 'error';
  }
?>

