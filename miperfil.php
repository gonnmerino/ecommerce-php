<?php
require_once('includes/session.php');
require_once('includes/header.php');
include('includes/conexion.php');

// Si no está logueado, redirigir a cuenta.php
if (!isset($_SESSION['user'])) {
    header('Location: cuenta.php');
    exit();
}

$email = $_SESSION['user'];

// Obtener datos del usuario si necesitas más información
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<body>
    <div class="min-h-screen bg-[#fffefe]">
        <?php include 'includes/nav.php'?>
        <form action="includes/logout.php" method="POST">
            <button type="submit" class="text-green-300 cursor-pointer hover:text-blue-300">
                Cerrar Sesión
            </button>
        </form>
    </div>
</body>
