<?php include 'includes/header.php' ?>
<?php require 'includes/conexion.php' ?>

<body>
  <div class="min-h-screen bg-[]">
    <?php
    include 'includes/nav.php';

    $categoria_id = 0;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

      if(isset($_POST['cat'])) {
        $categoria_id = $_POST['cat'];

        if(is_numeric($categoria_id) && $categoria_id > 0) {
           //echo 'es numeric ';
            $categoria_id = intval($categoria_id);
            $sql = 'SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen 
                FROM productos p 
                INNER JOIN categorias c ON p.categoria_id = c.id 
                WHERE p.activo = 1 AND p.categoria_id = ?';
            $stmt = $conn->prepare($sql);
           $stmt->bind_param('i', $categoria_id);
            $stmt->execute();
            $result = $stmt->get_result();
         if($result ->num_rows > 0) {
          while($row = $result ->fetch_assoc()) {
            $imagen_producto = $row['imagen'];
            if($imagen_producto == null) {
              $imagen_producto = 'src\images\image-placeholder.jpg';
            }
            echo '<div class="flex flex-wrap justify-center">
                <div class="w-80 m-4">
                    <div class="bg-[#f6f7f6] rounded-xl transition-all duration-300 overflow-hidden h-full flex flex-col">
                        <div class="p-4 flex justify-center items-center h-64 bg-[#f4f5f5]">
                            <img src="' . htmlspecialchars($imagen_producto) . '" alt="' . htmlspecialchars($row['nombre']) . '" class="object-contain max-h-full w-full transition-transform duration-300 hover:scale-105">
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold text-[#010001] mb-1 leading-tight">' . htmlspecialchars($row['nombre']) . '</h3>
                            <p class="text-xs  mx-0.5 text-neutral-600 mb-3 description overflow-hidden whitespace-nowrap text-ellipsis">' . htmlspecialchars($row['descripcion']) . '</p>
                            <div class="mt-auto"> 
                                <p class="text-xl  mx-0.5 font-bold text-[#010001] price mb-3">$ ' . htmlspecialchars($row['precio']) . '</p>
                        </div>
                            <button class="cursor-pointer w-full text-sm font-medium py-2 rounded-lg bg-yellow-300 text-[#010001] hover:bg-yellow-250 transition-all duration-200">Agregar al Carrito</button>
                        </div>
                    </div>
                </div>';
            };
            echo '</div>';
                }
                echo '</div>';
            } else {
                echo '<p class="text-center">No se encontraron productos en esta categoría</p>';
            }
            
            $stmt->close();
        } else {
            echo '<p class="text-center text-red-500">Error: ID de categoría inválido</p>';
        }
    } else {
        echo '<p class="text-center">Selecciona una categoría</p>';
    }
    ?>
</div>
</body>
