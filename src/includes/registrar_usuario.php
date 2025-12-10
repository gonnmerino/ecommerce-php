<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'conexion.php';

require_once BASE_PATH . '/cuenta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password =mysqli_real_escape_string($conn, $_POST['password']);


    $checkEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query("$checkEmail");
    $activo = 1;
    $admin = 0;
   
    
    $admin = 0;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($password)) {
        echo "<script>
                alert('La contraseña no puede estar vacía');
                window.location = '" . BASE_URL . "cuenta.php';
              </script>";
        exit();
    }
    if ($resultado->num_rows >= 1) {
      echo "<script>
          alert('Esta cuenta ya existe');
          window.location = '" . BASE_URL . "cuenta.php';
        </script>";
      exit();
    } else {
         $sql = "INSERT INTO usuarios(email, contraseña, activo, admin) VALUES ('$email', '$hashed_password', '$activo', $admin)";
        echo 'Todo correcto';
        if ($conn->query($sql) === TRUE) {
            echo ' Cuenta creada!';
            Header('Location:' . BASE_URL . 'cuenta.php');
            exit();
        } else {
            echo 'Error al crear la cuenta' . $sql . $conn->error;
        }
    }
}
