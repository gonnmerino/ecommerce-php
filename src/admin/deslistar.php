<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_id'])) {

    $id = intval($_POST['toggle_id']);
    $sql = "SELECT activo FROM productos WHERE id = $id";
    $resultt = $conn->query($sql);
    $estado = $resultt->fetch_assoc()['activo'];
    $nuevoEstado = ($estado == 1) ? 0 : 1;

    $update = "UPDATE productos SET activo = $nuevoEstado WHERE id = $id";
    $conn->query($update);

    header("Location:" . ADMIN_URL . "admin-panel.php");
    exit();
}

