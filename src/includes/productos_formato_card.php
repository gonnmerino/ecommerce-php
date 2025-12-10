<?php
if (isset($datos) && !empty($datos)) {
    $producto = $datos;
} elseif (isset($row) && !empty($row)) {
    $producto = $row;
} else {
    return;
}
$id = $producto['id'] ?? 0;
$nombre = $producto['nombre'] ?? '';
$descripcion = $producto['descripcion'] ?? '';
$precio = $producto['precio'] ?? 0;
$stock = $producto['stock'] ?? 0;
$activo = $producto['activo'] ?? 0;
$sku = $producto['sku'] ?? '';
$imagen = $producto['imagen'] ?? 'image-placeholder.jpg';
$categoria_nombre = $producto['categoria_nombre'] ?? 'Sin categoría';
$categoria_id = $producto['categoria_id'] ?? 0;

$imagen_producto = isset($imagen_producto) ? $imagen_producto : (IMAGES_URL . $imagen);
$descripcionLimitada = isset($descripcionLimitada) ? $descripcionLimitada : (strlen($descripcion) > 40 ? substr($descripcion, 0, 40) . '...' : $descripcion);
?>

<div class="bg-neutral-900 border border-neutral-800 rounded-xl shadow-lg flex flex-col overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="w-full h-80 overflow-hidden">
        <img src="<?php echo htmlspecialchars($imagen_producto); ?>" 
             alt="<?php echo htmlspecialchars($nombre); ?>" 
             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
    </div>
    
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-white text-lg font-semibold">
            <?php echo htmlspecialchars($nombre); ?>
        </h3>

        <p class="text-neutral-400 text-sm mt-2 flex-grow">
            <?php echo $descripcionLimitada; ?>
        </p>

        <div class="mt-4">
            <?php if (($stock ?? 0) > 0): ?>
                <span class="text-green-400 text-sm">En stock</span>
            <?php else: ?>
                <span class="text-red-400 text-sm">Sin stock</span>
            <?php endif; ?>
        </div>

        <p class="text-xl text-white font-semibold mt-2">
            $ <?php echo number_format($precio, 2); ?>
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
</div>