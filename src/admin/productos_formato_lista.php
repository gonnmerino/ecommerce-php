<?php
require_once __DIR__ . '/../../config.php';
  $id = $datos['id'] ?? 0;
  $nombre = $datos['nombre'] ?? '';
  $descripcion = $datos['descripcion'] ?? '';
  $precio = $datos['precio'] ?? 0;
  $stock = $datos['stock'] ?? 0;
  $activo = $datos['activo'] ?? 0;
  $sku = $datos['sku'] ?? '';
  $imagen = $datos['imagen'] ?? 'image-placeholder.jpg';
  $imagen_producto = !empty($imagen) ? $imagen : 'image-placeholder.jpg';
  $categoria_nombre = $datos['categoria_nombre'] ?? 'Sin categoría';
  $categoria_id = $datos['categoria_id'] ?? 0;
  $activo_class = $activo == 0 ? "opacity-40" : "";
  $estado = $activo == 1 ? 'Activo' : 'Inactivo';
  $estado_class = $activo == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
  $precio_formateado = number_format($precio, 2, ',', '.');
  $descripcion_corta = htmlspecialchars(mb_strimwidth($descripcion, 0, 40, "..."));
  $stock_bajo_html = $stock <= $stockNumberConfig ? "<div class='text-xs text-yellow-600'>Stock bajo</div>" : "";
  $toggle_text = $activo == 1 ? "Deslistar" : "Activar";
  $toggle_class = $activo == 1 ? "text-red-600 hover:text-red-400" : "text-green-600 hover:text-green-400";
  $timestamp = time();
?>

                    <tr class="<?php echo $activo_class; ?>">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="h-10 w-10 flex-shrink-0">
                            <img class="h-10 w-10 rounded object-cover"
                              src="../images/<?php echo htmlspecialchars($imagen_producto); ?>?v=<?php echo $timestamp; ?>"
                              alt="<?php echo htmlspecialchars($nombre); ?>">
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                              <?php echo htmlspecialchars($nombre); ?>
                            </div>
                            <div class="text-sm text-gray-500">
                              <?php echo htmlspecialchars($categoria_nombre); ?>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php echo $descripcion_corta; ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <?php echo htmlspecialchars($sku); ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                        $<?php echo $precio_formateado; ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          <?php echo $stock; ?>
                        </div>
                        <?php echo $stock_bajo_html; ?>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $estado_class; ?>">
                          <?php echo $estado; ?>
                        </span>
                      </td>


                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex flex-row">

                          <button id="edit-btn" onclick="openModalEdit(this)"

                            data-id="<?php echo $id; ?>"
                            data-nombre="<?php echo htmlspecialchars($nombre); ?>"
                            data-descripcion="<?php echo htmlspecialchars($descripcion); ?>"
                            data-categoria="<?php echo $categoria_id; ?>"
                            data-precio="<?php echo $precio; ?>"
                            data-stock="<?php echo $stock; ?>"
                            data-imagen="<?php echo htmlspecialchars($imagen); ?>"
                            class="text-gray-600 cursor-pointer hover:text-gray-900 mr-4">
                            Editar
                          </button>
                          <form method="POST" action="<?php echo ADMIN_URL ?>deslistar.php">

                            <input type="hidden" name="toggle_id" value="<?php echo $id; ?>">

                            <button class="user-decoration:none cursor-pointer <?php echo $toggle_class; ?>">
                              <?php echo $toggle_text; ?>
                            </button>

                          </form>
                        </div>
                      </td>
                    </tr>