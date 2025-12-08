<?php
require_once __DIR__ . '/../../config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'conexion.php';

if (!isset($admin) || $admin != 1) {
  Header('Location:' . BASE_URL . 'index.php');
  exit;
}

$sql_stockConfig = "SELECT stock_bajo_numero FROM cfg_panel";
$result_config = $conn->query($sql_stockConfig);
$rown = $result_config->fetch_assoc();
$stockNumberConfig = $rown['stock_bajo_numero'];
//echo $stockNumberConfig;
$total = $conn->query("SELECT COUNT(*) AS total FROM productos")->fetch_assoc()['total'];

$sql_pagConfig = "SELECT por_pagina FROM cfg_panel";
$result_config = $conn->query($sql_pagConfig);
$rown = $result_config->fetch_assoc();
$por_pagina = $rown['por_pagina'];

$pagina_actual = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($pagina_actual - 1) * $por_pagina;

$total_paginas = ceil($total / $por_pagina);


$sql_productos = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, p.activo, p.sku, p.imagen, p.categoria_id, p.fecha_creacion, c.nombre as categoria_nombre 
FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id ORDER BY CASE WHEN p.activo = 1 THEN 0 else 1 END, p.id DESC LIMIT $por_pagina OFFSET $offset";
//$result_productos = $conn->query($sql_productos);
$productos = $conn->query($sql_productos);
$sql_contadores = " SELECT SUM(CASE WHEN activo = 1 THEN 1 ELSE 0 END) AS activos,SUM(CASE WHEN activo = 0 THEN 1 ELSE 0 END) AS inactivos,  SUM(CASE WHEN stock < $stockNumberConfig AND stock > 0 THEN 1 ELSE 0 END) AS stock_bajo
  FROM productos";

$contadores = $conn->query($sql_contadores)->fetch_assoc();

$activos = $contadores['activos'];
$inactivos = $contadores['inactivos'];
$stock_bajo = $contadores['stock_bajo'];
//$sku = $contadores['sku'];

//busqueda-productos
$busquedaUsuario = isset($_GET['busqueda-productos']) ? $_GET['busqueda-productos'] : '';

if(!empty($busquedaUsuario) && $busquedaUsuario != ' ') {
  $stmt3 = $conn->prepare("SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, p.activo, p.sku, p.imagen, p.categoria_id, c.nombre as categoria_nombre 
  FROM productos p  LEFT JOIN categorias c ON p.categoria_id = c.id WHERE p.nombre LIKE ? OR p.descripcion LIKE ? OR p.sku LIKE ?");

  $busqueda_param = "%" . $busquedaUsuario . "%";

  $stmt3->bind_param("sss", $busqueda_param, $busqueda_param, $busqueda_param);
  $stmt3->execute();

  $resultadoBusqueda = $stmt3->get_result();
  

  $stmt3->close();
}

?>

<body class="bg-white">
  <div class="min-h-screen">
    <?php include INCLUDES_PATH . 'nav.php'; ?>
    <div class="p-6 mx-65">
      <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Admin Panel</h1>
        <p class="text-gray-600 mt-1">Panel de administracion de cuentas, pruductos y su stock.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600">Producto totales</p>
              <p class="text-2xl font-semibold text-gray-900 mt-1"><?php echo $total; ?></p>
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
              <p class="text-sm text-gray-600">Productos con Stock bajo <span class="text-xs">(Ajuste actual: <?php echo htmlspecialchars($stockNumberConfig) ?>)</span></p>
              <p class="text-2xl font-semibold text-gray-900 mt-1">
                <?php
                echo $stock_bajo;
                ?>
              </p>
            </div>
            <div class="flex flex-row gap-1.5">
              <button id="stock-cfg" onclick="openStockConfig(this)" title="Cambiar la configuracion de stock" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-gray-600 transition duration-600 active:scale-85 hover:text-gray-800" x="0px" y="0px" width="22" height="22" viewBox="0 0 24 24">
                <path d="M 9.6660156 2 L 9.2148438 4.4765625 L 9.2285156 4.4707031 L 9.3574219 4.4296875 C 9.3071239 4.442262 9.2639589 4.4626482 9.2148438 4.4765625 C 8.2970203 4.7365804 7.576324 5.2179722 6.9589844 5.7324219 L 6.9257812 5.7617188 L 6.9238281 5.7617188 L 4.5351562 5.0039062 L 2.2382812 8.9863281 L 4.1113281 10.748047 L 4.1191406 10.703125 L 4.1289062 10.658203 C 3.9908562 11.210378 4 11.7 4 12 C 4 12.3 3.9990261 12.795912 4.1191406 13.396484 L 4.1074219 13.332031 L 2.2246094 14.992188 L 4.5527344 19.027344 L 6.9433594 18.158203 L 6.9628906 18.177734 L 7.0449219 18.232422 C 7.6875911 18.660868 8.4330772 19.088227 9.2070312 19.419922 L 9.2109375 19.421875 L 9.6582031 22 L 14.333984 22 L 14.785156 19.523438 L 14.771484 19.529297 L 14.642578 19.570312 C 14.692876 19.557738 14.736041 19.537352 14.785156 19.523438 C 15.70298 19.26342 16.423675 18.782028 17.041016 18.267578 L 17.074219 18.238281 L 17.076172 18.238281 L 19.476562 19.001953 L 21.765625 14.882812 L 19.892578 13.230469 L 19.880859 13.296875 L 19.871094 13.341797 C 20.009129 12.789573 20 12.3 20 12 C 20 11.7 20.0091 11.210382 19.871094 10.658203 L 19.876953 10.683594 L 21.775391 9.0078125 L 19.447266 4.9726562 L 17.056641 5.8417969 L 17.037109 5.8222656 L 16.955078 5.7675781 C 16.312365 5.3391322 15.566923 4.9117728 14.792969 4.5800781 L 14.789062 4.578125 L 14.341797 2 L 9.6660156 2 z M 11.333984 4 L 12.658203 4 L 13.009766 6.0214844 L 14.029297 6.4277344 L 14.005859 6.4199219 C 14.611316 6.6794033 15.240023 7.0391194 15.785156 7.3984375 L 16.542969 8.1582031 L 18.552734 7.4257812 L 19.224609 8.5917969 L 17.722656 9.9179688 L 17.919922 11.103516 L 17.929688 11.142578 C 17.991611 11.390399 18 11.7 18 12 C 18 12.3 17.991597 12.609601 17.929688 12.857422 L 17.923828 12.880859 L 17.707031 13.96875 L 19.234375 15.318359 L 18.523438 16.599609 L 16.523438 15.962891 L 15.746094 16.740234 C 15.202979 17.191429 14.762748 17.47777 14.158203 17.628906 L 14.091797 17.646484 L 13.015625 18.076172 L 12.666016 20 L 11.341797 20 L 10.990234 17.978516 L 9.9707031 17.572266 L 9.9941406 17.580078 C 9.3886846 17.320609 8.7599774 16.960881 8.2148438 16.601562 L 7.4570312 15.841797 L 5.4472656 16.574219 L 4.7753906 15.408203 L 6.2929688 14.068359 L 6.0800781 13.003906 C 6.0001926 12.604479 6 12.3 6 12 C 6 11.7 6.0083605 11.390399 6.0703125 11.142578 L 6.0761719 11.119141 L 6.2890625 10.052734 L 4.7617188 8.6132812 L 5.4648438 7.3964844 L 7.4765625 8.0371094 L 8.2539062 7.2597656 C 8.7970213 6.8085705 9.2372522 6.5222299 9.8417969 6.3710938 L 9.9082031 6.3535156 L 10.984375 5.9238281 L 11.333984 4 z M 12 8 C 9.7901961 8 8 9.7901961 8 12 C 8 14.209804 9.7901961 16 12 16 C 14.209804 16 16 14.209804 16 12 C 16 9.7901961 14.209804 8 12 8 z M 12 10 C 13.190196 10 14 10.809804 14 12 C 14 13.190196 13.190196 14 12 14 C 10.809804 14 10 13.190196 10 12 C 10 10.809804 10.809804 10 12 10 z"></path>
                </svg>
              </button>

              <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="fixed inset-0 bg-black opacity-50 z-40 hidden" id="stockModalBackdrop"></div>
      <div class="fixed inset-0 flex items-center justify-center hidden z-50" id="stockModalContent">
        <div class="bg-white w-75 p-6 rounded-sm shadow-lg max-w-lg mx-4 border border-gray-300">
          <form method="POST" action="actualizar_stock_config.php">
            <h3 class="text-lg font-bold mb-4 text-gray-900">Configuracion</h3>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">¿Con cuantos productos ya considera bajo stock?</label>
              <input type="number" name="stockNumberCfg" min="0" required id="editStock-config" placeholder="¿Que considera bajo stock?" class="w-full mb-4 border border-gray-300 px-3 py-2 rounded-sm">
            </div>
            <div class="flex justify-end space-x-3 mt-1">
              <button type="button" onclick="closeStockModalEdit()" class="px-4 py-2 border border-gray-300 rounded-sm cursor-pointer hover:bg-gray-200">
                Cancelar
              </button>
              <button type="submit" id="stock-guardar-btn" class="px-4 py-2 bg-black text-white rounded-sm cursor-pointer hover:bg-gray-800">
                Guardar cambios
              </button>
            </div>
          </form>
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
            <form method="GET">
              <div class="flex flex-row gap-4">
              <input type="text" name="busqueda-productos" placeholder="Buscar Productos..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
            </form>

              <a id="pag-cfg" onclick="openPagConfig(this)" class="cursor-pointer m-auto transition duration-150 active:scale-85" title="Cambiar la configuracion de paginado" >
              <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" fill="currentColor" class=" text-gray-600  hover:text-gray-800 w-7 h-7" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 438 511.52">
                <path fill-rule="nonzero" d="M141.44 0h172.68c4.71 0 8.91 2.27 11.54 5.77L434.11 123.1a14.37 14.37 0 0 1 3.81 9.75l.08 251.18c0 17.62-7.25 33.69-18.9 45.36l-.07.07c-11.67 11.64-27.73 18.87-45.33 18.87h-20.06c-.3 17.24-7.48 32.9-18.88 44.29-11.66 11.66-27.75 18.9-45.42 18.9H64.3c-17.67 0-33.76-7.24-45.41-18.9C7.24 480.98 0 464.9 0 447.22V135.87c0-17.68 7.23-33.78 18.88-45.42C30.52 78.8 46.62 71.57 64.3 71.57h12.84V64.3c0-17.68 7.23-33.78 18.88-45.42C107.66 7.23 123.76 0 141.44 0zm30.53 250.96c-7.97 0-14.43-6.47-14.43-14.44 0-7.96 6.46-14.43 14.43-14.43h171.2c7.97 0 14.44 6.47 14.44 14.43 0 7.97-6.47 14.44-14.44 14.44h-171.2zm0 76.86c-7.97 0-14.43-6.46-14.43-14.43 0-7.96 6.46-14.43 14.43-14.43h136.42c7.97 0 14.43 6.47 14.43 14.43 0 7.97-6.46 14.43-14.43 14.43H171.97zM322.31 44.44v49.03c.96 12.3 5.21 21.9 12.65 28.26 7.8 6.66 19.58 10.41 35.23 10.69l33.39-.04-81.27-87.94zm86.83 116.78-39.17-.06c-22.79-.35-40.77-6.5-53.72-17.57-13.48-11.54-21.1-27.86-22.66-48.03l-.14-2v-64.7H141.44c-9.73 0-18.61 4-25.03 10.41C110 45.69 106 54.57 106 64.3v319.73c0 9.74 4.01 18.61 10.42 25.02 6.42 6.42 15.29 10.42 25.02 10.42H373.7c9.75 0 18.62-3.98 25.01-10.38 6.45-6.44 10.43-15.3 10.43-25.06V161.22zm-84.38 287.11H141.44c-17.68 0-33.77-7.24-45.41-18.88-11.65-11.65-18.89-27.73-18.89-45.42v-283.6H64.3c-9.74 0-18.61 4-25.03 10.41-6.41 6.42-10.41 15.29-10.41 25.03v311.35c0 9.73 4.01 18.59 10.42 25.01 6.43 6.43 15.3 10.43 25.02 10.43h225.04c9.72 0 18.59-4 25.02-10.43 6.17-6.17 10.12-14.61 10.4-23.9z"/>
              </svg>
              </a>
              </div>
              <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
          </div>
          <button onclick="añadirNuevoProducto()" class="bg-black text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 cursor-pointer hover:scale-[1.05] transition active:scale-[.95]">
            Añadir un producto
          </button>
        </div>
        <!-- MODEL PAGINADO -->
      <div class="fixed inset-0 bg-black opacity-50 z-40 hidden" id="pagModalBackdrop"></div>
      <div class="fixed inset-0 flex items-center justify-center hidden z-50" id="pagModalContent">
        <div class="bg-white w-80 p-6 rounded-sm shadow-lg max-w-lg mx-4 border border-gray-300">
          <form method="POST" action="actualizar_paginado_config.php">
            <h3 class="text-lg font-bold mb-4 text-gray-900">Configuracion</h3>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">¿Cuantos productos por pagina?</label>
              <input type="number" name="pagNumberCfg" min="0" required id="editPag-config" placeholder="¿Cuantos productos por pagina?" class="w-full mb-4 border border-gray-300 px-3 py-2 rounded-sm">
            </div>
            <div class="flex justify-center space-x-5 mt-1">
              <button type="button" onclick="closePagModalEdit()" class="px-4 py-2 border border-gray-300 rounded-sm cursor-pointer hover:bg-gray-200">
                Cancelar
              </button>
              <button type="submit" id="pag-guardar-btn" class="px-4 py-2 bg-black text-white rounded-sm cursor-pointer hover:bg-gray-800">
                Guardar cambios
              </button>
            </div>
          </form>
        </div>
      </div>

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripcion</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php
            if(empty($busquedaUsuario)) {
              $productos->data_seek(0);
              if ($productos->num_rows > 0) {
                // WHILE MUY IMPORTANTE MUESTA TODOS LOS PRODUCTOS
                while ($row = $productos->fetch_assoc()) {
                      $datos = $row;
                      include ADMIN_PATH . 'productos_formato_lista.php';
                  //TODO '...' clickeable y expande el texto en "DESCRIPCION"
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
              } else  {
                  if ($resultadoBusqueda->num_rows > 0) {
                    while ($productoEncontrado = $resultadoBusqueda->fetch_assoc()) {
                      $datos = $productoEncontrado;
                      include ADMIN_PATH . 'productos_formato_lista.php';
                    }
                } else {
                          echo "<tr>
                <td colspan='7' class='px-6 py-12 text-center'>
                    <div class='inline-block p-6 bg-gray-50 rounded-lg'>
                        <div class='text-4xl mb-4'></div>
                        <h3 class='text-lg font-medium text-gray-900 mb-2'>No se encontraron productos</h3>
                        <p class='text-gray-600 mb-4'>
                            No existe el producto: <span class='font-medium'>\"" . 
                            htmlspecialchars($busquedaUsuario) . "\"</span>
                        </p>
                        <a href='?' class='inline-block antialiased px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800'>
                            Ver todos los productos
                        </a>
                    </div>
                </td>
              </tr>";
                }
                }
              ?>
            </tbody>
          </table>
        </div>

        <div class="fixed inset-0 bg-black opacity-50 z-40 hidden" id="modalBackdrop"></div>
        <div class="fixed inset-0 flex items-center justify-center hidden z-50" id="modalContent">
          <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 border border-gray-300">
            <h3 id="tituloModal" class="text-lg font-bold mb-4 text-gray-900"></h3>
            <form id="editProductoForm" method="POST" action="" enctype="multipart/form-data">
              <input type="hidden" name="id" id="editProductId">
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                  <input type="text" name="nombre" id="editNombre" required placeholder="Nombre del producto" class="w-full border border-gray-300 px-3 py-2 rounded-lg">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Descripcion</label>
                  <textarea type="text" name="descripcion" id="editDescripcion" required placeholder="Agrega una descripcion al producto" class="w-full border max-h-60 border-gray-300 px-3 py-2 rounded-lg"></textarea>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                  <select name="categoria_id" id="editCategoria" class="w-full border border-gray-300 px-3 py-2 rounded-lg" required>
                    <option value="">Seleccionar...</option>
                    <?php $cat;
                    $sql_categorias = "SELECT id, nombre FROM categorias";
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
                  <input type="number" name="precio" min="0" id="editPrecio" required placeholder="Coloca un precio al producto" class="w-full border border-gray-300 px-3 py-2 rounded-lg">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                  <input type="number" name="stock" min="0" required id="editStock" placeholder="¿Cuantas unidades tiene el producto?" class="w-full border border-gray-300 px-3 py-2 rounded-lg">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                  <input type="file" name="imagen" id="editImagen" placeholder="Pone una imagen al producto" class="w-full cursor-pointer border border-gray-300 px-3 py-2 rounded-lg">
                </div>
                <div>
                  <!--<img id="mostrarImagen" name="Imagen" class='h-20 w-20 rounded object-cover' src="src/images/" . > TODO Preview de las-->
                </div>
              </div>
              <div class="flex justify-end space-x-3 mt-1">
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
      <?php
      require_once ADMIN_PATH . 'admin_usuarios.php';
      ?>
    
    <div id="paginado-productos" class="flex gap-4 flex-wrap justify-center mt-4">
      <?php
      for ($i = 1; $i <= $total_paginas; $i++) {
        $color = ($i == $pagina_actual) ? "bg-black text-white hover:bg-gray-800" : "bg-gray-200 hover:bg-gray-800 hover:text-white text-black";
        echo "<a class='px-4 py-2 rounded-lg $color' href='?page=$i'>$i</a>";
      }
      ?>
    </div>
    </div>
  </div>
  <script src="admin-scripts.js"></script>
</body>

</html>