<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';
require_once INCLUDES_PATH . 'manejar_imagen.php';

  if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
      die('errror');
  }
  $nuevoNombre = trim($_POST['nombre']);
  $nuevaCategoria = trim($_POST['categoria_id']);
  $nuevoPrecio = trim($_POST['precio']);
  $nuevoStock  = trim($_POST['stock']);
  $nuevaDescripcion = trim($_POST['descripcion']);
  $nombreParaSku = str_replace(' ', '-', strtolower($nuevoNombre));
  if(!is_numeric($nuevoPrecio) || $nuevoPrecio < 0) {
    die('error el precio mo es valido'); 
  } 
  if(!is_numeric($nuevoStock) || $nuevoStock < 0) {
    die('error el stock mo es valido'); 
  } 
  if(empty($nuevoNombre) || empty($nuevoPrecio) || empty($nuevoStock) || empty($nuevaDescripcion)) {
    die('faltan llenar campos'); 
  }
  $fechaHoraActual = date('YmdHis');
  $sku = $nombreParaSku;
  $stmt = $conn->prepare("INSERT INTO productos (nombre, categoria_id, precio, sku, stock, descripcion) VALUES (?, ?, ?, ?,?, ?)");
  $stmt->bind_param("siisis", $nuevoNombre, $nuevaCategoria, $nuevoPrecio, $sku, $nuevoStock, $nuevaDescripcion); // TODO CATEGORIA, TODO SKU
  if (!$stmt->execute()) {
      die("Error.");
  }

  $id = $stmt->insert_id;

  $sku = $nombreParaSku .'-'. $id;
  $stmt2 = $conn->prepare("UPDATE productos SET sku = ? WHERE id = ?");
  $stmt2->bind_param("si", $sku, $id);
  if (!$stmt2->execute()) {
    die("error");
  }
  $nuevaImagen = procesarImagen("imagen", $nuevoNombre, $id);
  if ($nuevaImagen !== null) {
      $stmt2 = $conn->prepare("UPDATE productos SET imagen = ? WHERE id = ?");
      $stmt2->bind_param("si", $nuevaImagen, $id);
      if (!$stmt2->execute()) {
          die("error");
      }
  }

  Header('Location:' . ADMIN_URL . 'admin-panel.php');
?>

