<?php include 'includes/header.php' ?>


<body>
  <div class="min-h-screen bg-[]">
    <?php
    include 'includes/nav.php';

    $sql_id = "SELECT id FROM categorias WHERE nombre = 'Componentes'"; // cambiar 'Componentes' hay quehacerlo dinamico
    $resultado_id = $conn->query($sql_id);
    if ($resultado_id && $resultado_id->num_rows > 0) {
      $fila_id = $resultado_id->fetch_assoc();
      $id_de_componentes = $fila_id['id'];
      //echo "id es: " . $id_de_componentes;
    } else {
      echo "<p>Error: no existe.</p>";
      exit;
    }

    $placeholder_image = 'src\images\image-placeholder.jpg';

    $sql_productos = "SELECT nombre, descripcion, precio, imagen FROM productos WHERE categoria_id IN 
        (SELECT id FROM categorias WHERE id = " . $id_de_componentes . " UNION SELECT id FROM categorias WHERE categoria_padre_id = " . $id_de_componentes . ")";
    $resultado_productos = $conn->query($sql_productos);
    if ($resultado_productos && $resultado_productos->num_rows > 0) {
      //este es el div par la alineacion de las cards
      echo '<div class="productos-container flex flex-row flex-wrap justify-center text-1xl font-[Segoe UI]">';
      while ($fila = $resultado_productos->fetch_assoc()) {
        $nombre = htmlspecialchars($fila['nombre']);
        $descripcion = htmlspecialchars($fila['descripcion']);
        $precio = number_format($fila['precio'], 2, ',', '.');
        $imagen_db = $fila['imagen'];

        if (empty($imagen_db) || !file_exists($imagen_db)) {
            $imagen = $placeholder_image;
        } else {
            $imagen = htmlspecialchars($imagen_db);
        }
    ?>
    <div class="product-card w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-1 max-w-xs mb-4 mx-2">
      
      <div class="bg-[#f6f7f6] rounded-xl transition-all duration-300 overflow-hidden h-full flex flex-col">
        
        <div class="p-4 flex justify-center items-center h-64 bg-[#f4f5f5]">
          <img 
            src="<?php echo $imagen; ?>" 
            alt="<?php echo $nombre; ?>" 
            class="object-contain max-h-full w-full transition-transform duration-300 hover:scale-105"
          >
        </div>

        <div class="p-4 flex flex-col flex-grow">
          
          <h3 class="text-lg font-semibold text-[#010001] mb-1 leading-tight">
            <?php echo $nombre; ?>
          </h3>
          
          <p class="text-xs text-neutral-600 mb-3 description overflow-hidden whitespace-nowrap text-ellipsis">
            <?php echo $descripcion; ?>
          </p>

          <div class="mt-auto"> 
              <p class="text-xl font-bold text-[#010001] price mb-3">
                $ <?php echo $precio; ?>
              </p>
          </div>

          <button 
            class="cursor-pointer w-full text-sm font-medium py-2 rounded-lg bg-yellow-300 text-[#010001] hover:bg-yellow-250 transition-all duration-200" >
            Agregar al Carrito
          </button>
        </div>
      </div>
    </div>
    <?php
      }
      echo '</div>';
    } else {
      echo "<p>no hay products en esta categoria</p>";
    }
    ?>
  </div>
</body>
<?php include 'includes/footer.php' ?>