<?php

include 'includes/header.php';
require_once 'includes/conexion.php';
require_once 'includes/session.php';

if (!isset($admin) || $admin != 1) {
  Header('Location: index.php');
  exit;
}

$sql_usuarios = "SELECT id, email, activo, admin FROM usuarios ";
$result_usuarios = $conn->query($sql_usuarios);
$sql_productos = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, p.activo, p.sku,  p.imagen, p.fecha_creacion, c.nombre as categoria_nombre 
                  FROM productos p 
                  LEFT JOIN categorias c ON p.categoria_id = c.id";
$result_productos = $conn->query($sql_productos);
?>

<body>
  <div class="min-h-screen bg-[#fffefe]">
    <?php include 'includes/nav.php'; ?>

    <div class="md:flex flex-col mt-10 pb-10 mx-4 sm:mx-6 md:mx-8 lg:mx-16 xl:mx-24">
      <ul class="flex-column space-y space-y-6 text-sm font-medium text-gray-500 dark:text-gray-400 md: mb-4 md:mb-0 select-none">

        <li class="bg-[#161618] rounded-lg">
          <a id="btn-productos" onclick="toggleProductos()"
            class="inline-flex cursor-pointer items-center px-4 py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100 w-full dark:hover:bg-gray-700 dark:hover:text-white bg-gray-700 text-white"
            aria-current="page">
            <svg class="w-4 h-4 me-2 text-white dark:text-gray-400" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
              <path
                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
            </svg>
            Productos
          </a>

          <div id="productos-admin" style="display: block;" class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <div
              class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
              <div>
                <button id="dropdownActionButtonProductos" data-dropdown-toggle="dropdownActionProductos"
                  class="inline-flex items-center ml-4 text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                  type="button">
                  <span class="sr-only">Action button</span>
                  Acción
                  <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4" />
                  </svg>
                </button>
                <div id="dropdownActionProductos"
                  class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownActionButtonProductos">
                    <li>
                      <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activar productos</a>
                    </li>
                    <li>
                      <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Desactivar productos</a>
                    </li>
                    <li>
                      <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar stock</a>
                    </li>
                  </ul>
                  <div class="py-1">
                    <a href="#"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Eliminar productos</a>
                  </div>
                </div>
              </div>
              <label for="table-search-productos" class="sr-only">Search</label>
              <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                  </svg>
                </div>
                <input type="text" id="table-search-productos"
                  class="block p-2 mr-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Buscar un producto...">
              </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="p-4">
                    <div class="flex items-center">
                      <input id="selectAllProductos" onclick="toggleAllProductosCheckboxes()" type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="selectAllProductos" class="sr-only">checkbox</label>
                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Nombre
                  </th>
                  <th scope="col" class="px-6 py-3">
                    SKU
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Precio
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Stock
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Categoría
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Estado
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Acción
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result_productos->num_rows > 0) {
                  while ($row = $result_productos->fetch_assoc()) {
                    $estado = $row['activo'] == 1 ? 'Activo' : 'Inactivo';
                    $color_estado = $row['activo'] == 1 ? 'bg-green-500' : 'bg-red-500';
                    $precio_formateado = number_format($row['precio'], 2, ',', '.');

                    echo "
                    <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600'>
                      <td class='w-4 p-4'>
                        <div class='flex items-center'>
                          <input id='checkbox-producto-{$row['id']}' type='checkbox' class='checkbox-producto w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                          <label for='checkbox-producto-{$row['id']}' class='sr-only'>checkbox</label>
                        </div>
                      </td>
                        <th scope='row' class='flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white'>
                          <div class='ps-3'>
                            <div class='text-base font-semibold'>" . htmlspecialchars($row['nombre']) . "</div>
                            <div class='font-normal text-gray-500'>" . htmlspecialchars(substr($row['descripcion'], 0, 50)) . "...</div>
                          </div>
                        </th>
                          <td class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>" . htmlspecialchars($row['sku']) . "</td>
                          <td class='px-6 py-4'>$" . $precio_formateado . "</td>
                          <td class='px-6 py-4'>" . $row['stock'] . "</td>
                          <td class='px-6 py-4'>" . htmlspecialchars($row['categoria_nombre']) . "</td>
                          <td class='px-6 py-4'>
                            <div class='flex items-center'>
                              <div class='h-2.5 w-2.5 rounded-full $color_estado me-2'></div> $estado
                            </div>
                      </td>
                        <td class='px-6 py-4'>
                          <a href='editar_producto.php?id={$row['id']}' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Editar</a>
                        </td>
                    </tr>";
                  }
                } else {
                  echo "<tr><td colspan='8' class='px-6 py-4 text-center'>No hay productos registrados</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </li>

        <li>
          <a id="btn-cuentas" onclick="toggleCuentas()"
            class="inline-flex cursor-pointer items-center px-4 py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100 w-full dark:hover:bg-gray-700 dark:hover:text-white bg-[#161618] text-gray-400"
            aria-current="page">
            <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
            </svg>Cuentas
          </a>

          <div id="cuentas-admin" style="display: none;" class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <div
              class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="p-4">
                    <div class="flex items-center">
                      <input id="selectAllCheckbox" onclick="toggleAllCheckboxes()" type="checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="selectAllCheckbox" class="sr-only">checkbox</label>
                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3">Email</th>
                  <th scope="col" class="px-6 py-3">Tipo de Usuario</th>
                  <th scope="col" class="px-6 py-3">Cuenta Activa</th>
                  <th scope="col" class="px-6 py-3">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result_usuarios->num_rows > 0) {
                  while ($row = $result_usuarios->fetch_assoc()) {
                    $tipo_usuario = $row['admin'] == 1 ? 'Administrador' : 'Usuario';
                    $estado_cuenta = $row['activo'] == 1 ? 'Activa' : 'Inactiva';

                    echo 
                      "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600'>
                        <td class='w-4 p-4'>
                          <div class='flex items-center'>
                            <input id='checkbox-for-account-{$row['id']}' type='checkbox' class='checkbox-for-account w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                            <label for='checkbox-for-account-{$row['id']}' class='sr-only'>checkbox</label>
                          </div>
                        </td>
                          <th scope='row' class='flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white'>
                            <div class='ps-3'>
                              <div class='text-base font-semibold'>" . htmlspecialchars($row['email']) . "</div>
                            </div>
                          </th>
                          <td class='px-6 py-4'>" . $tipo_usuario . "</td>
                          <td class='px-6 py-4'>
                            <div class='flex items-center'>
                              <div class='me-2'></div> " . $estado_cuenta . "
                            </div>
                          </td>
                        <td class='px-6 py-4'>
                          <a href='editar_usuario.php?id={$row['id']}' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Editar</a>
                        </td>
                       </tr>";
                  }
                } else {
                  echo "<tr><td colspan='5' class='px-6 py-4 text-center'>No hay usuarios registrados</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script>
    const productos_show = document.getElementById('productos-admin');
    const btn_productos = document.getElementById('btn-productos');
    const cuentas_show = document.getElementById('cuentas-admin');
    const btn_cuentas = document.getElementById('btn-cuentas');

    function toggleProductos() {
      if (productos_show.style.display === 'none' || productos_show.style.display === '') {
        productos_show.style.display = 'block';
        btn_productos.classList.add('bg-gray-700', 'text-white');
        btn_productos.classList.remove('hover:text-gray-900', 'text-gray-400');

        cuentas_show.style.display = 'none';
        btn_cuentas.classList.remove('bg-gray-700', 'text-white');
        btn_cuentas.classList.add('hover:text-gray-900', 'text-gray-400');
      } else {
        productos_show.style.display = 'none';
        btn_productos.classList.remove('bg-gray-700', 'text-white');
        btn_productos.classList.add('hover:text-gray-900', 'text-gray-400');
      }
    }

    function toggleCuentas() {
      if (cuentas_show.style.display === 'none' || cuentas_show.style.display === '') {
        cuentas_show.style.display = 'block';
        btn_cuentas.classList.add('bg-gray-700', 'text-white');
        btn_cuentas.classList.remove('hover:text-gray-900', 'text-gray-400');

        productos_show.style.display = 'none';
        btn_productos.classList.remove('bg-gray-700', 'text-white');
        btn_productos.classList.add('hover:text-gray-900', 'text-gray-400');
      } else {
        cuentas_show.style.display = 'none';
        btn_cuentas.classList.remove('bg-gray-700', 'text-white');
        btn_cuentas.classList.add('hover:text-gray-900', 'text-gray-400');
      }
    }

    function toggleAllProductosCheckboxes() {
      const selectAllProductos = document.getElementById('selectAllProductos');
      const checkboxesProductos = document.getElementsByClassName('checkbox-producto');

      for (let i = 0; i < checkboxesProductos.length; i++) {
        checkboxesProductos[i].checked = selectAllProductos.checked;
      }
    }

    function toggleAllCheckboxes() {
      const selectAllCheckbox = document.getElementById('selectAllCheckbox');
      const checkboxes = document.getElementsByClassName('checkbox-for-account');

      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = selectAllCheckbox.checked;
      }
    }
  </script>
</body>

</html>