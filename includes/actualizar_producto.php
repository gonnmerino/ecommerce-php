<?php
require_once 'session.php';
require 'conexion.php';

  $id = $_POST['id'];

  $nuevoNombre = trim($_POST['nombre']);
  $nuevoPrecio = trim($_POST['precio']);
  $nuevoStock = trim($_POST['stock']);
  $imagen = trim($_POST['imagen']);
  $nuevaImagen = null;

  $sql = "SELECT imagen FROM productos WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($imagenActual);
  $stmt->fetch();
  $stmt->close();
  $nuevaImagen = $imagenActual;


  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

      $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

      $nombreLimpio = strtolower(
          preg_replace('/[^a-zA-Z0-9]+/', '-', $nuevoNombre)
      );

      $nombreFinal = $nombreLimpio . '-' . $id . '.' . $extension;
      $destino = __DIR__ . '/../src/images/' . $nombreFinal;

      move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
      $nuevaImagen = $nombreFinal;
  }

  $sql = 'UPDATE productos SET nombre = ?, precio =?, stock = ?, imagen = ? WHERE id = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("siisi", $nuevoNombre, $nuevoPrecio, $nuevoStock, $nuevaImagen, $id);

  if($stmt ->execute()) {
    Header('Location: ../admin-panel.php');
  } else {
    echo 'error';
  }

?>

