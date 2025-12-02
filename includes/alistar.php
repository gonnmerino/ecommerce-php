<?php
require_once 'conexion.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productId = $_POST['id'];

      $query = "UPDATE productos SET activo = 1 WHERE id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $productId);
      
      if ($stmt->execute()) {
          echo 'todo ok';
      } else {
          echo 'error';
      }

      $stmt->close();
      $conn->close();
  }
?>
