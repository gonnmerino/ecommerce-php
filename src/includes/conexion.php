<?php
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $bdname = "web2";
    $conn = new mysqli($host, $usuario, $contrasena, $bdname);
    mysqli_set_charset($conn, 'utf8mb4');

    if ($conn->connect_error) {
        die("". $conn->connect_error);
    }
?>