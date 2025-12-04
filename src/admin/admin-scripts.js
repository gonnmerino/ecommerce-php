    function añadirNuevoProducto() {
      document.getElementById('editProductoForm').reset();
      document.getElementById('editProductId').value = "";
      document.getElementById('modalBackdrop').classList.remove('hidden');
      document.getElementById('modalContent').classList.remove('hidden');
      document.getElementById('tituloModal').textContent = "Añade un nuevo producto"
      document.getElementById('guardar-btn').textContent = "Añadir"
      document.getElementById("editProductoForm").action = "añadir_producto.php";
    }
    function openStockConfig(button) {
      const btnStockConfig = document.getElementById('stock-config-btn');
      const stockNumberCfg = button.getAttribute('StockcfgDATA')
      document.getElementById('editStock-config').value = stockNumberCfg;
      document.getElementById('stockModalBackdrop').classList.remove('hidden');
      document.getElementById('stockModalContent').classList.remove('hidden');
      document.getElementById('editStock-config').focus();
    }
    function closeStockModalEdit() {
      document.getElementById('stockModalBackdrop').classList.add('hidden');
      document.getElementById('stockModalContent').classList.add('hidden');
    }
    function openModalEdit(button) {
      document.getElementById("editProductoForm").action = "actualizar_producto.php";
      document.getElementById('tituloModal').textContent = "Edita un producto"
      document.getElementById('guardar-btn').textContent = "Guardar cambios"
      const id = button.getAttribute('data-id');
      const nombre = button.getAttribute('data-nombre');
      const descripcion = button.getAttribute('data-descripcion');
      const categoria = button.getAttribute('data-categoria');
      const precio = button.getAttribute('data-precio');
      const stock = button.getAttribute('data-stock');
      const imagen = button.getAttribute('data-imagen');
      document.getElementById('editProductId').value = id;
      document.getElementById('editNombre').value = nombre;
      document.getElementById('editDescripcion').value = descripcion;
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

