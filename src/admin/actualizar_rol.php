<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';

  $usuario_id = intval($_POST['usuario_id']);

  $rol = $_POST['rolSeleccion'];

  if ($rol === 'rolAdmin') {
      $valor = 1;
  } else {
      $valor = 0;
  }
  $stmt = $conn->prepare("UPDATE usuarios SET admin = ? WHERE id = ?");
  $stmt->bind_param("ii", $valor, $usuario_id);
  $stmt->execute();
  //echo 'actualizado';
  //Forbidden You don't have permission to access this resource. ?? 
  header("Location: " . ADMIN_URL . "admin-panel.php");
      exit();


?>