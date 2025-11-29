<?php
require_once 'conexion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password =mysqli_real_escape_string($conn, $_POST['password']);


    //Check de mail
    $checkEmail = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = $conn->query("$checkEmail");
    $activo = 1;
    $admin = 0;
   
    
    $admin = 0;
    //Hashing de password, Codifica la contraseña para mejor seguridad
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($password)) {
        echo "<script>
                alert('La contraseña no puede estar vacía');
                window.location = '../cuenta.php';
              </script>";
        exit();
    }
    //Verifica que no hayan mas de una fila con el mismo mail (cuentas duplicadas)
    if ($resultado->num_rows >= 1) {
        echo 'Esta cuenta ya existe';
    } else {
        //Crea la query con todos los datos solicitados y usando la password hasheada
         $sql = "INSERT INTO usuarios(email, contraseña, activo, admin) VALUES ('$email', '$hashed_password', '$activo', $admin)";
        echo 'Todo correcto';
        //Si todos los datos son correctos, envia la query y avisa al usuario
        if ($conn->query($sql) === TRUE) {
            echo ' Cuenta creada!';
            Header('Location: ../cuenta.php');
            exit();
        } else {
            echo 'Error al crear la cuenta' . $sql . $conn->error;
        }
    }
}
