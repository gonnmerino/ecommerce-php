<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'conexion.php';
?>
<body>
  <div class="min-h-screen bg-[]">
    <?php
    include INCLUDES_PATH . 'nav.php';

    $categoria_id = 0;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

      if(isset($_POST['cat'])) {
        $categoria_id = $_POST['cat'];

        if(is_numeric($categoria_id) && $categoria_id > 0) {
           //echo 'es numeric ';
            $categoria_id = intval($categoria_id);
            $sql = 'SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id 
            WHERE p.activo = 1 AND p.categoria_id = ?';
            $stmt = $conn->prepare($sql);
           $stmt->bind_param('i', $categoria_id);
            $stmt->execute();
            $result = $stmt->get_result();
         if($result ->num_rows > 0) {
          echo '
          <div class="xl:mx-70 mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 p-4">';
          while($row = $result ->fetch_assoc()) {
            $urlImagen = IMAGES_URL;
            $imagen_producto = $urlImagen . $row['imagen'];
            if($row['imagen'] == null) {
              $imagen_producto = $urlImagen . 'image-placeholder.jpg';
            }
            echo '
            <div class="w-full">
                <div class="bg-[#f6f7f6] rounded-xl transition-all duration-300 overflow-hidden h-full flex flex-col">
                    <div class=" flex justify-center items-center h-64 bg-[#f4f5f5]">
                        <img src="' . htmlspecialchars($imagen_producto) . '" 
                            alt="' . htmlspecialchars($row['nombre']) . '" 
                            class="object-cover max-h-full w-full transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold text-[#010001] mb-1 leading-tight">' . htmlspecialchars($row['nombre']) . '</h3>

                        <p class="text-xs mx-0.5 text-neutral-600 mb-3 overflow-hidden whitespace-nowrap text-ellipsis">
                            ' . htmlspecialchars($row['descripcion']) . '
                        </p>
                        <div class="mt-auto">
                            <p class="text-xl mx-0.5 font-bold text-[#010001] mb-3">
                                $ ' . htmlspecialchars($row['precio']) . '
                            </p>
                        </div>
                        <button class="cursor-pointer w-full text-sm font-medium py-2 rounded-lg bg-yellow-300 text-[#010001] hover:bg-[#fce13f] transition-all duration-200">
                            Agregar al Carrito
                        </button>
                    </div>
                </div>
            </div>';
            
          }

          echo '</div></div>';
                }
                echo '</div>';
            } else {
                echo '<p class="text-center">No se encontraron productos en esta categoría</p>';
            }
            
            $stmt->close();
        } else {
            echo '<p class="text-center text-red-500">error categoria invalida</p>';
        }
    } else {
        echo '
      <div class="flex flex-col overflow-hidden bg-red-100 justify-center items-center" 
           style="height: calc(100vh - 143px);">
        <div class="-translate-y-3/12">
        <h3 class="text-4xl font-medium text-center mb-35 text-[#262626] antialiased">Esta pagina aun no existe.</h3>

        <video class="w-100 m-auto rounded-sm" autoplay muted loop>
          <source src="/src/images/Video.webm" type="video/webm">
        </video>
        </div>
      </div>';
    }
    ?>
</div>

</body>

