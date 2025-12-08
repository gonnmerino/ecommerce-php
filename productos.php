<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'conexion.php';
?>

<body>
  <div class="min-h-screen bg-[#0b0b0a]">
    
    <?php
    include INCLUDES_PATH . 'nav.php';
      echo'<div class="xl:mx-70">';
    $categoria_id = 0;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      if (isset($_POST['cat'])) {
        $categoria_id = $_POST['cat'];

        if (is_numeric($categoria_id) && $categoria_id > 0) {
          //echo 'es numeric ';
          $categoria_id = intval($categoria_id);
          $sql = 'SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id 
            WHERE p.activo = 1 AND p.categoria_id = ?';
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $categoria_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            echo '
          
            <div class="grid mt-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 p-4">';
            while ($row = $result->fetch_assoc()) {

              $urlImagen = IMAGES_URL;
              $imagen_producto = $row['imagen'] ? $urlImagen . $row['imagen'] : $urlImagen . 'image-placeholder.jpg';
              $descripcion = htmlspecialchars($row['descripcion']);
              $max = 40;
              $descripcionLimitada = strlen($descripcion) > $max
                ? substr($descripcion, 0, $max) . '...'
                : $descripcion;
              echo '
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl shadow-lg flex flex-col overflow-hidden">

                    <div class="w-full h-80 overflow-hidden">
                        <img src="' . htmlspecialchars($imagen_producto) . '" 
                            alt="' . htmlspecialchars($row['nombre']) . '" 
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">

                        <h3 class="text-white text-lg font-semibold">
                            ' . htmlspecialchars($row['nombre']) . '
                        </h3>

                        <p class="text-neutral-400 text-sm mt-2">
                            ' . $descripcionLimitada . '
                        </p>

                        <p class="text-xl text-white font-semibold mt-4">
                            $ ' . htmlspecialchars($row['precio']) . '
                        </p>
                        <button class="group cursor-pointer relative inline-flex h-12 items-center justify-center 
                                      overflow-hidden rounded-md bg-yellow-400 px-6 font-medium text-gray-900 
                                      w-full mt-4 transition hover:scale-105">
                            <span>Agregar al carrito</span>
                            <div class="absolute inset-0 flex h-full w-full justify-center 
                                        [transform:skew(-12deg)_translateX(-100%)] 
                                        group-hover:duration-1000 
                                        group-hover:[transform:skew(-12deg)_translateX(100%)]">
                                <div class="relative h-full w-8 bg-white/20"></div>
                            </div>
                        </button>

                    </div>
                </div>';
            }
          }else {
            echo '
            <div class="flex flex-col items-center justify-center h-[60vh] text-center">
                <h2 class="text-white text-3xl font-bold mb-4">Esta categoría ya no tiene más productos</h2>
                <p class="text-neutral-400 text-lg mb-6">Explora más productos en otras categorías</p>
              <button onclick="window.location.href=\'' . BASE_URL . 'index.php\'" class="group cursor-pointer relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-yellow-400 px-6 font-medium text-gray-900 max-w-80 mt-4 transition hover:scale-105">
                <span>Ver otras categorias</span>
                  <div class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                  <div class="relative h-full w-8 bg-white/20"></div>
                </div>
              </button>
            </div>';
          };
        } else {
            header("Location: 404.php");
            exit();
        }
        $stmt->close();
      } else {
        header("Location: 404.php");
        exit();
      }
    } else {
      header("Location: 404.php");
      exit();
    }
    ?>
  </div>
  </div>
  <?php
  include INCLUDES_PATH . 'footer.php';
  ?>
</body>