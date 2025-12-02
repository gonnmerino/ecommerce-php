<?php
include 'includes/header.php';
require_once 'includes/conexion.php';
require_once 'includes/session.php';


if (!isset($admin) || $admin != 1) {
  Header('Location: index.php');
  exit;
}

  $sql_usuarios = "SELECT id, email, activo, admin FROM usuarios";
  $result_usuarios = $conn->query($sql_usuarios);

  $sql_productos = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, p.activo, p.sku, p.imagen, p.categoria_id, p.fecha_creacion, c.nombre as categoria_nombre 
                    FROM productos p 
                    LEFT JOIN categorias c ON p.categoria_id = c.id";
  $result_productos = $conn->query($sql_productos);

  $total_productos = $result_productos->num_rows;
?>

<body class="bg-white">
  <div class="min-h-screen">
    <?php include 'includes/nav.php'; ?>

    <?php
     // PRUEBAS
        

        //Tuesday, December 2, 2025, 02:14:09am

        //TD22025021409

        //$SKU =

        //$nuevoNombre = 'Ryzen 5 5600g';

        //$nuevoNombre = str_replace(' ', '-', strtolower($nuevoNombre));

        //$fechaHoraActual = date('YmdHis');

        //$SKU = $nuevoNombre . $fechaHoraActual;


    ?>


    <div class="p-6">
      <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Admin Panel</h1>
        <p class="text-gray-600 mt-1">Panel de administracion de cuentas, pruductos y su stock.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600">Producto totales</p>
              <p class="text-2xl font-semibold text-gray-900 mt-1"><?php echo $total_productos; ?></p>
            </div>
            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600">Activo</p>
              <p class="text-2xl font-semibold text-gray-900 mt-1">
                <?php 
                $result_productos->data_seek(0);
                $activos = 0;
                while($row = $result_productos->fetch_assoc()) {
                    if($row['activo'] == 1) $activos++;
                }
                echo $activos;
                ?>
              </p>
            </div>
            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600">Inactivo</p>
              <p class="text-2xl font-semibold text-gray-900 mt-1">
                <?php 
                $result_productos->data_seek(0);
                $inactivos = 0;
                while($row = $result_productos->fetch_assoc()) {
                    if($row['activo'] == 0) $inactivos++;
                }
                echo $inactivos;
                ?>
              </p>
            </div>
            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600">Productos con Stock bajo</p>
              <p class="text-2xl font-semibold text-gray-900 mt-1">
                <?php 
                $result_productos->data_seek(0);
                $stock_bajo = 0;
                while($row = $result_productos->fetch_assoc()) {
                    if($row['stock'] < 6 && $row['stock'] > 0) $stock_bajo++;
                }
                echo $stock_bajo;
                ?>
              </p>
            </div>
            <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-6">
        <div class="border-b border-gray-200">
          <nav class="-mb-px flex space-x-8">
            <button onclick="showSection('products')" id="products-tab" class="border-b-2 cursor-pointer border-black py-4 px-1 text-sm font-medium text-gray-900 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
              Productos
            </button>
            <button onclick="showSection('users')" id="users-tab" class="border-b-2 cursor-pointer border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
              Cuentas
            </button>
          </nav>
        </div>
      </div>

      <div id="products-section">
        <div class="mb-6 flex justify-between items-center">
          <div class="relative w-80">
            <input type="text" placeholder="Buscar Productos..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
          <button onclick="añadirNuevoProducto()" class="bg-black text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 cursor-pointer transition-colors">
            Añadir un producto
          </button>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php
              $result_productos->data_seek(0);
              if ($result_productos->num_rows > 0) {
                while ($row = $result_productos->fetch_assoc()) {
                  $estado = $row['activo'] == 1 ? 'Activo' : 'Inactivo';
                  $estado_class = $row['activo'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                  $precio_formateado = number_format($row['precio'], 2, ',', '.');
                  $imagen_producto = !empty($row['imagen']) ? $row['imagen'] : 'image-placeholder.jpg';

                  echo "
                  <tr class='hover:bg-gray-50'>
                    <td id='col1' class='px-6 py-4 whitespace-nowrap bg-red'>
                      <div class='flex items-center'>
                        <div class='h-10 w-10 flex-shrink-0'>
                          <img  class='h-10 w-10 rounded object-cover' src='src/images/" . htmlspecialchars($imagen_producto . '?v=' . time())  . "' alt='" . htmlspecialchars($row['nombre']) . "'>
                        </div>
                        <div class='ml-4'>
                          <div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($row['nombre']) . "</div>
                          <div class='text-sm text-gray-500'>" . htmlspecialchars($row['categoria_nombre']) . "</div>
                        </div>
                      </div>
                    </td>
                    <td id='col2' class='px-6 py-4 whitespace-nowrap text-sm text-gray-900'>" . htmlspecialchars($row['sku']) . "</td>
                    <td id='col3' class='px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium'>$" . $precio_formateado . "</td>
                    <td id='col4' class='px-6 py-4 whitespace-nowrap'>
                      <div class='text-sm text-gray-900'>" . $row['stock'] . "</div>
                      " . ($row['stock'] < 6 ? "<div class='text-xs text-yellow-600'>Stock bajo</div>" : "") . "
                    </td>
                    <td id='col5' class='px-6 py-4 whitespace-nowrap'>
                      <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium $estado_class'>
                        $estado
                      </span>
                    </td>
                    <td id='col6' class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>
                      <button id='edit-btn' onclick='openModalEdit(this)' 
                      data-id='" . $row['id'] . "' 
                      data-nombre='" . $row['nombre'] . "'
                      data-categoria='" . $row['categoria_id'] . "'
                      data-precio='" . $row['precio'] . "' 
                      data-stock='" . $row['stock'] . "' 
                      data-imagen='" . $row['imagen'] . "' 
                      class='text-gray-600 cursor-pointer hover:text-gray-900 mr-4'>Editar</button>
                      <button type='submit' id='deslistar-btn' onclick='deslistar()' class='text-red-600 hover:text-red-900 cursor-pointer'>Deslistar</button>
                    </td>
                  </tr>";
                }
              } else {
                echo "
                <tr>
                  <td colspan='6' class='px-6 py-12 text-center text-gray-500'>
                    <svg class='w-12 h-12 mx-auto mb-4 text-gray-400' fill='currentColor' viewBox='0 0 20 20'>
                      <path fill-rule='evenodd' d='M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z' clip-rule='evenodd'/>
                    </svg>
                    No se encontraron productos
                  </td>
                </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

        <div class="fixed inset-0 bg-black opacity-50 z-40 hidden" id="modalBackdrop"></div>
        <div class="fixed inset-0 flex items-center justify-center hidden z-50" id="modalContent">
          <div class="bg-white p-6 rounded-sm shadow-lg w-full max-w-lg mx-4 border border-gray-300">
            <h3 id="tituloModal" class="text-lg font-bold mb-4 text-gray-900"></h3>
            <form id="editProductoForm" method="POST" action="" enctype="multipart/form-data">
              <input type="hidden" name="id" id="editProductId">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                  <input type="text" name="nombre" id="editNombre" required placeholder="Nombre del producto" class="w-full border border-gray-300 px-3 py-2 rounded-sm">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                  <select name="categoria_id" id="editCategoria" class="w-full border border-gray-300 px-3 py-2 rounded-sm" required>
                      <option value="">Seleccionar...</option>
                      <?php $sql_categorias = "SELECT id, nombre FROM categorias";
                            $result_categorias = $conn->query($sql_categorias);
                              if ($result_categorias->num_rows > 0) {
                                while ($cat = $result_categorias->fetch_assoc()) {
                                  echo "<option value='{$cat['id']}'>{$cat['nombre']}</option>";
                                }
                              }
                      ?>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                  <input type="number" name="precio" min="0" id="editPrecio" required placeholder="Coloca un precio al producto" class="w-full border border-gray-300 px-3 py-2 rounded-sm">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                  <input type="number" name="stock" min="0"required id="editStock"  placeholder="¿Cuantas unidades tiene el producto?" class="w-full border border-gray-300 px-3 py-2 rounded-sm">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1" >Imagen</label>
                  <input type="file" name="imagen" id="editImagen" placeholder="Pone una imagen al producto" class="w-full cursor-pointer border border-gray-300 px-3 py-2 rounded-sm">
                </div>
              </div>
              <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModalEdit()" class="px-4 py-2 border border-gray-300 rounded-sm cursor-pointer hover:bg-gray-200">
                  Cancelar
                </button>
                <button id="guardar-btn" type="submit" class="px-4 py-2 bg-black text-white rounded-sm cursor-pointer hover:bg-gray-800">
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div id="users-section" class="hidden">
        <div class="mb-6">
          <div class="relative w-80">
            <input type="text" placeholder="Buscar Cuentas..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de cuenta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado de la cuenta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php
              if ($result_usuarios->num_rows > 0) {
                while ($row = $result_usuarios->fetch_assoc()) {
                  $tipo_usuario = $row['admin'] == 1 ? 'Admin' : 'Usuario';
                  $tipo_class = $row['admin'] == 1 ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800';
                  $estado_cuenta = $row['activo'] == 1 ? 'Activa' : 'Inactiva';
                  $estado_class = $row['activo'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';

                  echo "
                  <tr class='hover:bg-gray-50'>
                    <td class='px-6 py-4 whitespace-nowrap'>
                      <div class='flex items-center'>
                        <div class='h-10 w-10 flex-shrink-0 bg-gray-200 rounded-full flex items-center justify-center'>
                          <svg class='w-5 h-5 text-gray-500' fill='currentColor' viewBox='0 0 20 20'>
                            <path fill-rule='evenodd' d='M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z' clip-rule='evenodd'/>
                          </svg>
                        </div>
                        <div class='ml-4'>
                          <div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($row['email']) . "</div>
                        </div>
                      </div>
                    </td>
                    <td class='px-6 py-4 whitespace-nowrap'>
                      <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium $tipo_class'>
                        $tipo_usuario
                      </span>
                    </td>
                    <td class='px-6 py-4 whitespace-nowrap'>
                      <span class='inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium $estado_class'>
                        $estado_cuenta
                      </span>
                    </td>
                    <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>
                      <button class='text-gray-600 cursor-pointer hover:text-gray-900'>Editar</button>
                    </td>
                  </tr>";
                }
              } else {
                echo "
                <tr>
                  <td colspan='4' class='px-6 py-12 text-center text-gray-500'>
                    <svg class='w-12 h-12 mx-auto mb-4 text-gray-400' fill='currentColor' viewBox='0 0 20 20'>
                      <path fill-rule='evenodd' d='M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z' clip-rule='evenodd'/>
                    </svg>
                    No se encontraron usuarios
                  </td>
                </tr>";
              }
              
              ?>
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div>

  <script>

    function añadirNuevoProducto() {
      document.getElementById('editProductoForm').reset();
      document.getElementById('editProductId').value = "";
      document.getElementById('modalBackdrop').classList.remove('hidden');
      document.getElementById('modalContent').classList.remove('hidden');
      document.getElementById('tituloModal').textContent = "Añade un nuevo producto"
      document.getElementById('guardar-btn').textContent = "Añadir"
      document.getElementById("editProductoForm").action = "includes/añadir_producto.php";
    }

    function deslistar() {
      document.getElementById('deslistar-btn').addEventListener('click', function () {
        
        const col1 = document.getElementById('col1');
        const col2 = document.getElementById('col2')
        const col3 = document.getElementById('col3')
        const col4 = document.getElementById('col4')
        const col5 = document.getElementById('col5')
        const col6 = document.getElementById('col6')
        col1.classList.add('opacity-40')
        col2.classList.add('opacity-40')
        col3.classList.add('opacity-40')
        col4.classList.add('opacity-40')
        col5.classList.add('opacity-40')
        col6.classList.add('opacity-40')
      })
    }

    function openModalEdit(button) {
      document.getElementById("editProductoForm").action = "includes/actualizar_producto.php";
      document.getElementById('tituloModal').textContent = "Edita un producto"
      document.getElementById('guardar-btn').textContent = "Guardar cambios"
      const id = button.getAttribute('data-id');
      const nombre = button.getAttribute('data-nombre');
      const categoria = button.getAttribute('data-categoria');
      const precio = button.getAttribute('data-precio');
      const stock = button.getAttribute('data-stock');
      const imagen = button.getAttribute('data-imagen');
      document.getElementById('editProductId').value = id;
      document.getElementById('editNombre').value = nombre;
      document.getElementById("editCategoria").value = categoria;
      document.getElementById('editPrecio').value = precio;
      document.getElementById('editStock').value = stock;
      document.getElementById('editImagen').value = '';
      document.getElementById('modalBackdrop').classList.remove('hidden');
      document.getElementById('modalContent').classList.remove('hidden');
    }

    function closeModalEdit() {
      document.getElementById('modalBackdrop').classList.add('hidden');
      document.getElementById('modalContent').classList.add('hidden');
    }

    function showSection(section) {
      document.getElementById('products-section').classList.add('hidden');
      document.getElementById('users-section').classList.add('hidden');

      document.getElementById('products-tab').classList.remove('border-black', 'text-gray-900');
      document.getElementById('products-tab').classList.add('border-transparent', 'text-gray-500');
      document.getElementById('users-tab').classList.remove('border-black', 'text-gray-900');
      document.getElementById('users-tab').classList.add('border-transparent', 'text-gray-500');

      document.getElementById(section + '-section').classList.remove('hidden');
      document.getElementById(section + '-tab').classList.add('border-black', 'text-gray-900');
      document.getElementById(section + '-tab').classList.remove('border-transparent', 'text-gray-500');
    }
  </script>
</body>
</html>