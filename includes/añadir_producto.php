<?php
require_once 'session.php';
require 'conexion.php';
require 'manejar_imagen.php';
require 'generador_sku.php';
  $nuevoNombre = trim($_POST['nombre']);
  $nuevoPrecio = trim($_POST['precio']);
  $nuevoStock  = trim($_POST['stock']);
  $nombreParaSku = str_replace(' ', '-', strtolower($nuevoNombre));
  if(!is_numeric($nuevoPrecio) || $nuevoPrecio < 0) {
    die('error el precio mo es valido'); 
  } 
  if(!is_numeric($nuevoStock) || $nuevoStock < 0) {
    die('error el stock mo es valido'); 
  } 
  if(empty($nuevoNombre) || empty($nuevoPrecio) || empty($nuevoStock)) {
    die('faltan llenar campos'); 
  }

  $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)");
  $stmt->bind_param("sii", $nuevoNombre, $nuevoPrecio, $nuevoStock);
  if (!$stmt->execute()) {
      die("Error.");
  }

    $id = $stmt->insert_id;

  $nuevaImagen = procesarImagen("imagen", $nuevoNombre, $id);
  if ($nuevaImagen !== null) {

      $fechaHoraActual = date('YmdHis');
      $sku = $nombreParaSku . $fechaHoraActual;

      $stmt2 = $conn->prepare("UPDATE productos SET imagen = ?, sku = ? WHERE id = ?");
      $stmt2->bind_param("si", $nuevaImagen,$sku, $id); // sku

      if (!$stmt2->execute()) {
          die("error");
      }
  }

  echo "TODO BIEN";
?>
