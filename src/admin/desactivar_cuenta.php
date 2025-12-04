<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_id'])) {

    $id = intval($_POST['toggle_id']);
    $sql = "SELECT activo FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $estado = $row['activo'];
        $nuevoEstado = ($estado == 1) ? 0 : 1;
        
        $update = "UPDATE usuarios SET activo = ? WHERE id = ?";
        $stmt_update = $conn->prepare($update);
        $stmt_update->bind_param("ii", $nuevoEstado, $id);
        $stmt_update->execute();
    }
    
    header("Location:" . ADMIN_URL . "admin-panel.php");
    exit();
}
?>

