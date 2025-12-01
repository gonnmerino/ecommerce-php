<?php
require_once 'conexion.php';


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
                window.location = '../cuenta.php';
              </script>";
        exit();
    }
    if ($resultado->num_rows >= 1) {
        echo 'Esta cuenta ya existe';
    } else {
         $sql = "INSERT INTO usuarios(email, contraseña, activo, admin) VALUES ('$email', '$hashed_password', '$activo', $admin)";
        echo 'Todo correcto';
        if ($conn->query($sql) === TRUE) {
            echo ' Cuenta creada!';
            Header('Location: ../cuenta.php');
            exit();
        } else {
            echo 'Error al crear la cuenta' . $sql . $conn->error;
        }
    }
}
