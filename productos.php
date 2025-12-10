<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'conexion.php';

$categoria_id = 0;
$busquedaProducto = isset($_GET['busqueda-productos']) ? trim($_GET['busqueda-productos']) : '';
$productos = [];
$modoBusqueda = false;
$tituloPagina = 'Productos';
$total = $conn->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()['total'];
$por_pagina = 20;

$pagina_actual = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($pagina_actual - 1) * $por_pagina;

$total_paginas = ceil($total / $por_pagina);
if (!empty($busquedaProducto)) {
    $modoBusqueda = true;
    $tituloPagina = 'Resultados de búsqueda: ' . htmlspecialchars($busquedaProducto);
    
    $stmt3 = $conn->prepare("SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen, p.stock, p.sku, c.nombre AS categoria_nombre, c.id AS categoria_id FROM productos p 
    INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.activo = 1 AND (p.nombre LIKE ? OR c.nombre LIKE ? OR p.descripcion LIKE ?)");
    $busqueda_param = "%" . $busquedaProducto . "%";
    $stmt3->bind_param("sss", $busqueda_param, $busqueda_param, $busqueda_param);
    $stmt3->execute();
    $resultadoBusqueda = $stmt3->get_result();
    
    if ($resultadoBusqueda->num_rows > 0) {
        while ($producto = $resultadoBusqueda->fetch_assoc()) {
            $productos[] = $producto;
        }
    }
    $stmt3->close();
}else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat'])) {
    $categoria_id = $_POST['cat'];
    
    if (!is_numeric($categoria_id) || $categoria_id <= 0) {
        header("Location: 404.php");
        exit();
    }
    
    $categoria_id = intval($categoria_id);
    
    $stmt_cat = $conn->prepare("SELECT nombre FROM categorias WHERE id = ?");
    $stmt_cat->bind_param('i', $categoria_id);
    $stmt_cat->execute();
    $result_cat = $stmt_cat->get_result();
    if ($cat_row = $result_cat->fetch_assoc()) {
        $tituloPagina = $cat_row['nombre'];
    }
    $stmt_cat->close();
    
    $sql = 'SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen, p.stock, p.sku, c.nombre AS categoria_nombre, c.id AS categoria_id 
        FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id  WHERE p.activo = 1 AND p.categoria_id = ? ORDER BY p.id DESC  LIMIT ? OFFSET ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $categoria_id, $por_pagina, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            $productos[] = $producto;
        }
    }
    $stmt->close();
      
  } else {
      header("Location: 404.php");
      exit();
  }

  require_once INCLUDES_PATH . 'header.php';
?>

<body>
  <div class="min-h-screen bg-[#0b0b0a]">
    <?php include INCLUDES_PATH . 'nav.php'; ?>
    
    <div class="xl:mx-70 p-4">
        <?php if ($modoBusqueda): ?>
            <h2 class="text-white text-2xl md:text-3xl font-bold mb-6">
                Resultados para: "<span class="text-yellow-400"><?php echo htmlspecialchars($busquedaProducto); ?></span>"
            </h2>
            <?php if (empty($productos)): ?>
                <div class="flex flex-col items-center justify-center h-[60vh] text-center">
                    <h2 class="text-white text-2xl font-bold mb-4">No se encontraron productos</h2>
                    <p class="text-neutral-400 text-lg mb-6">Intenta con otros términos de búsqueda</p>
                    <button onclick="history.back()" class="group cursor-pointer relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-yellow-400 px-6 font-medium text-gray-900 max-w-80 mt-4 transition hover:scale-105">
                        <span>Volver atrás</span>
                        <div class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                            <div class="relative h-full w-8 bg-white/20"></div>
                        </div>
                    </button>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h1 class="text-white text-2xl md:text-3xl font-bold mb-6">
                <?php echo htmlspecialchars($tituloPagina); ?>
            </h1>
        <?php endif; ?>
        <?php if (!empty($productos)): ?>
            <div class="grid mt-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                <?php foreach ($productos as $producto): 
                    $urlImagen = IMAGES_URL;
                    $imagen_producto = !empty($producto['imagen']) ? $urlImagen . $producto['imagen'] : $urlImagen . 'image-placeholder.jpg';
                    $descripcion = htmlspecialchars($producto['descripcion'] ?? '');
                    $max = 40;
                    $descripcionLimitada = strlen($descripcion) > $max ? substr($descripcion, 0, $max) . '...' : $descripcion;
                    $datos = $producto;
                ?>
                    <?php include INCLUDES_PATH . 'productos_formato_card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php elseif (!$modoBusqueda): ?>
            <div class="flex flex-col items-center justify-center h-[60vh] text-center">
                <h2 class="text-white text-3xl font-bold mb-4">Esta categoría ya no tiene más productos</h2>
                <p class="text-neutral-400 text-lg mb-6">Explora más productos en otras categorías</p>
                <button onclick="window.location.href='<?php echo BASE_URL; ?>index.php'" class="group cursor-pointer relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-yellow-400 px-6 font-medium text-gray-900 max-w-80 mt-4 transition hover:scale-105">
                    <span>Ver otras categorias</span>
                    <div class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                        <div class="relative h-full w-8 bg-white/20"></div>
                    </div>
                </button>
            </div>
        <?php endif; ?>
    </div>
      <div id="paginado-productos" class="flex gap-6 flex-wrap justify-center mt-4 mb-8">
      <?php
      for ($i = 1; $i <= $total_paginas; $i++) {
        $color = ($i == $pagina_actual) ? "bg-yellow-400 text-gray-900 text-white hover:bg-gray-800" : "bg-gray-200 hover:bg-[#272726] hover:text-white text-black";
        echo "<a class='px-5 py-3 font-bold rounded-lg $color' href='?page=$i'>$i</a>";
      }
      ?>
      </div>
    <?php include INCLUDES_PATH . 'footer.php'; ?>
  </div>
</body>
</html>