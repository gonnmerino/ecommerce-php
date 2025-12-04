<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';
  session_start();
  if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
      die('error');
  }
  $id = $_POST['id'];

  $nuevoNombre = trim($_POST['nombre']);
  $nuevaCategoria = trim($_POST['categoria_id']);
  $nuevoPrecio = trim($_POST['precio']);
  $nuevoStock = trim($_POST['stock']);
  $nuevaDescripcion = trim($_POST['descripcion']);
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
      $destino = IMAGES_PATH . $nombreFinal;

      move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
      $nuevaImagen = $nombreFinal;
      
  }

  $sql = 'UPDATE productos SET nombre = ?, categoria_id = ?, precio =?, stock = ?, descripcion = ?, imagen = ? WHERE id = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssiissi", $nuevoNombre, $nuevaCategoria, $nuevoPrecio, $nuevoStock, $nuevaDescripcion, $nuevaImagen, $id);

  if($stmt ->execute()) {
    Header('Location:' . ADMIN_URL . 'admin-panel.php');
  } else {
    echo 'error';
  }

?>

