<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'conexion.php';
require_once INCLUDES_PATH . 'header.php';
include INCLUDES_PATH . 'nav.php';

  $por_pagina = 20;
  $pagina_actual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $offset = ($pagina_actual - 1) * $por_pagina;

  $total_result = $conn->query("SELECT COUNT(*) AS total FROM productos WHERE activo = 1");
  $total = $total_result->fetch_assoc()['total'];

  $sql = 'SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen, p.stock, c.nombre AS categoria_nombre, c.id AS categoria_id  
  FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.activo = 1 ORDER BY p.id DESC LIMIT ? OFFSET ?';
          
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $por_pagina, $offset);
  $stmt->execute();
  $result = $stmt->get_result();

  $total_paginas = ceil($total / $por_pagina);
?>

<body>
<div class="min-h-screen bg-[#0b0b0a]">

    <div class="xl:mx-70 p-4">
      <h2 class="text-white text-2xl md:text-3xl font-bold mb-6">Todos los productos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
          
        <?php
        if ($result && $result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $urlImagen = IMAGES_URL;
                $imagen_producto = $row['imagen'] ? $urlImagen . $row['imagen'] : $urlImagen . 'image-placeholder.jpg';
                $descripcion = htmlspecialchars($row['descripcion']);
                $max = 40;
                $descripcionLimitada = strlen($descripcion) > $max
                    ? substr($descripcion, 0, $max) . '...'
                    : $descripcion;
                include INCLUDES_PATH . 'productos_formato_card.php';
            }

        } else {
            echo "<p class='text-center col-span-4'>No hay productos disponibles.</p>";
        }
        ?>
        </div>
    </div>
      <div id="paginado-productos" class="flex gap-6 flex-wrap justify-center mt-4 mb-8">
      <?php
      for ($i = 1; $i <= $total_paginas; $i++) {
        $color = ($i == $pagina_actual) ? "bg-yellow-400 text-gray-900 text-white hover:bg-gray-800" : "bg-gray-200 hover:bg-gray-800 hover:text-white text-black";
        echo "<a class='px-5 py-3 font-bold rounded-lg $color' href='?page=$i'>$i</a>";
      }
      ?>
</div>

<?php
include INCLUDES_PATH . 'footer.php';
?>
</body>
