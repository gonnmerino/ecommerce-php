<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'conexion.php';

// Si no está logueado, redirigir a cuenta.php
if (!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . 'cuenta.php');
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
        <?php include INCLUDES_PATH . 'nav.php'?>
        <form action="<?php echo BASE_URL; ?>logout.php" method="POST">
            <button type="submit" class="text-green-300 cursor-pointer hover:text-blue-300">
                Cerrar Sesión
            </button>
        </form>
    </div>
</body>
