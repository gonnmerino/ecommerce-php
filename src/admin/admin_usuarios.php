<?php
$sql_usuarios = "SELECT id, email, activo, admin FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);
?>
<div id="users-section" class="hidden">
  <div class="mb-6">
    <div class="relative w-80">
      <input type="text" placeholder="Buscar Cuentas..." class="w-full pl-10 pr-4 py-2 border  hidden border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-black">
      <svg class="w-5 h-5  hidden absolute left-3 top-2.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
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
            $tipo_class = $row['admin'] == 1 ? 'bg-red-600 text-white' : 'bg-blue-100 text-blue-800';

            $estado_cuenta = $row['activo'] == 1 ? 'Activa' : 'Inactiva';
            $estado_class = $row['activo'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';

            echo "
            <tr class='hover:bg-gray-50"  . ($row['activo'] == 0 ? "opacity-40" : "") . "'>
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
                <div class='flex gap-5 flex-row'>
                  <button onclick='openUsuarioConfig(this)' data-id-rol='" . $row['id'] . "' class='text-gray-600 cursor-pointer hover:text-gray-900 mr-4'>
                    Editar
                  </Button>
                  <form method='POST' action='" . ADMIN_URL . "desactivar_cuenta.php'>
                    <input type='hidden' name='toggle_id' value='" . $row['id'] . "'>
                    
                    <button class='user-decoration:none cursor-pointer " .
              ($row['activo'] == 1 ? "text-red-600 hover:text-red-400" : "text-green-600 hover:text-green-400") .  "'> 
                      " . ($row['activo'] == 1 ? "Desactivar" : "Activar") . "
                    </button>
                    
                  </form>
                </div>
              </td>
            </tr>";
          }
        } else {
          echo "<tr>
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

    <div class="fixed inset-0 bg-black opacity-50 z-40 hidden" id="usuarioModalBackdrop"></div>
    <div class="fixed inset-0 flex items-center justify-center hidden z-50" id="usuarioModalContent">
      <div class="bg-white w-75 p-6 rounded-lg shadow-lg max-w-lg mx-4 border border-gray-300">
        <form method="POST" action="actualizar_rol.php">
          <input type="hidden" name="usuario_id" id="usuario_id_input">
          <h3 class="text-lg font-bold mb-4 ml-1 text-gray-900">Cambio de rol</h3>
          <div>
            <label class="block text-sm font-medium ml-1 text-gray-700 mb-1">Asiga un rol a este usuario</label>
            <select name="rolSeleccion" id="editCategoria" class="w-full border cursor-pointer border-gray-300 px-3 py-2 rounded-lg" required>
            <option class="cursor-pointer" value="rolUsuario">Usuario</option>
            <option class="cursor-pointer" value="rolAdmin">Admin</option>
            </select>
          </div>
          <div class="flex justify-end space-x-3 mt-4">
            <button type="button" onclick="closeUsuarioModalEdit()" class="px-4 py-2 border border-gray-300 rounded-sm cursor-pointer hover:bg-gray-200">
              Cancelar
            </button>
            <button type="submit" id="usuario-guardar-btn" class="px-4 py-2 bg-black text-white rounded-sm cursor-pointer hover:bg-gray-800">
              Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </div>
    <script src="admin-scripts.js"></script>
  </div>
</div>