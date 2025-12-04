<?php include './src/includes/header.php'?>
<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'conexion.php';
include INCLUDES_PATH . 'nav.php';

$sql = "SELECT id, nombre, descripcion, precio, imagen 
        FROM productos 
        WHERE activo = 1";
$result = $conn->query($sql);
?>

<body>
<div class="min-h-screen bg-[]">

    <div class="xl:mx-70 mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 p-4">

        <?php
        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $urlImagen = IMAGES_URL;
                $imagen_producto = $row['imagen'] ? $urlImagen . $row['imagen'] : $urlImagen . 'image-placeholder.jpg';

                echo '
                <div class="w-full">
                    <div class="bg-[#f6f7f6] rounded-xl transition-all duration-300 overflow-hidden h-full flex flex-col">
                        <div class="flex justify-center items-center h-64 bg-[#f4f5f5]">
                            <img src="' . htmlspecialchars($imagen_producto) . '" 
                                alt="' . htmlspecialchars($row['nombre']) . '" 
                                class="object-cover max-h-full w-full transition-transform duration-300 hover:scale-105">
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold text-[#010001] mb-1 leading-tight">'
                                . htmlspecialchars($row['nombre']) .
                            '</h3>

                            <p class="text-xs mx-0.5 text-neutral-600 mb-3 overflow-hidden whitespace-nowrap text-ellipsis">'
                                . htmlspecialchars($row['descripcion']) .
                            '</p>

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

        } else {
            echo "<p class='text-center col-span-4'>No hay productos disponibles.</p>";
        }
        ?>
        </div>
    </div>

</div>
</body>
