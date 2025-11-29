<?php
include('session.php');
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));


    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $activo = (int)$user['activo'];
        if ($activo !== 1) {
            //echo 'Cuenta inactiva";
            echo "<script>
                    alert('Cuenta inactiva');
                    window.location = '../cuenta.php';
                </script>";
        } elseif (password_verify($password, $user['contraseña'])) {
            $_SESSION['user'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            echo 'Todo correcto el login';
            require_once('session.php');
            Header('Location: ../index.php');
            exit();
        }
         else {
            //echo $password;
            echo ' / contraseña equivocada';
            
        }
    } else {
        echo 'email no existe';
    }
}
