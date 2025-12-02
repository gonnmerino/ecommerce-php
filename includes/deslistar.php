<?php
require 'conexion.php';

$id = $_POST['id'];
$estado = $_POST['estado'];
$nuevo = $estado == 1 ? 0 : 1;

$query = "UPDATE productos SET activo = $nuevo WHERE id = $id";
echo $conn->query($query) ? 'OK' : 'ERROR';