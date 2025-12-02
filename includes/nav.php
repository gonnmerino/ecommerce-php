<?php
require_once("session.php");
require("conexion.php");

$user_display = "";
$profile_link = "../cuenta.php";
$estaLogueado = isset($_SESSION['user']);
$esAdmin = isset($admin) && $admin == 1;

if (isset($_SESSION['user'])) {
  $user_display = $_SESSION['user'];
  $profile_link = "miperfil.php";
}

$stmt = $conn->prepare("SELECT id, nombre FROM categorias WHERE mostrar_en_nav = 1");
$stmt->execute();
$categorias = $stmt->get_result();

$subcategorias = [];
$stmt_sub = $conn->prepare("SELECT id, nombre, categoria_padre_id FROM categorias WHERE categoria_padre_id IS NOT NULL");
$stmt_sub->execute();
$result_sub = $stmt_sub->get_result();

  while ($subcat = $result_sub->fetch_assoc()) {
      $subcategorias[$subcat['categoria_padre_id']][] = $subcat;
  }
$categorias->data_seek(0);
?>

<div class="w-full bg-neutral-800 text-white text-xs text-center py-1">
  Envios gratis a todo el pais!
</div>

<nav class="relative w-full bg-black bg-opacity-90 backdrop-filter backdrop-blur-md px-4 py-3 z-50">
  <div class="max-w-7xl mx-auto flex items-center justify-between relative">

    <div class="w-full mx-auto flex items-center justify-between hidden lg:flex">

      <div class="flex-shrink-0 w-1/5 flex items-center">
        <a href="index.php" class="flex-shrink-0">
          <h1 class="font-bold text-2xl text-white tracking-widest hover:text-gray-300">
            ECO
          </h1>
        </a>
      </div>

      <div class="flex-grow flex justify-center mx-4 items-center" style="max-width: 55%;">
        <div class="relative w-full">
          <input type="text" placeholder="Buscar productos, componentes, marcas..."
            class="w-full pl-12 pr-4 py-2.5 text-base rounded-full bg-white text-gray-900 placeholder-gray-500 border border-transparent focus:outline-none focus:ring-2 focus:ring-gray-600 shadow-lg transition-shadow duration-200" />

          <svg class="absolute left-4 top-3 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
      </div>

      <div class="flex items-center justify-end gap-4 flex-shrink-0 w-1/4">

        <?php if ($estaLogueado): ?>
          <div class="hidden xl:flex flex-col items-end text-right text-xs leading-none justify-center">
            <span class="text-gray-400">Bienvenido</span>
            <a href="<?php echo $profile_link; ?>" class="text-white font-medium hover:text-gray-300 transition-colors duration-200 whitespace-nowrap">
              <?php echo htmlspecialchars($user_display); ?>
            </a>
          </div>
        <?php endif; ?>

        <a href="#" class="text-white hover:text-gray-300 transition-colors duration-200 p-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </a>

        <a href="<?php echo $profile_link; ?>" class="text-white hover:text-gray-300 transition-colors duration-200 p-1 hidden lg:block">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </a>
        <?php if ($esAdmin): ?>
          <a href="../admin-panel.php" class="hidden lg:block text-white bg-red-600 hover:bg-red-700 text-xs font-bold py-1 px-3 rounded-full transition-colors duration-200">
            ADMIN
          </a>
        <?php endif; ?>
      </div>
    </div>

    <div class="w-full flex items-center justify-between lg:hidden">
      <a href="index.php" class="flex-shrink-0">
        <h1 class="font-bold text-2xl text-white tracking-widest">ECO</h1>
      </a>

      <div class="flex items-center gap-4">
        <a href="#" class="text-white hover:text-gray-300 transition-colors duration-200 p-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </a>
        <a href="<?php echo $profile_link; ?>" class="text-white hover:text-gray-300 transition-colors duration-200 p-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </a>
        <button id="menu-btn" class="p-2 rounded-md text-white hover:bg-gray-800 transition-colors duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

  </div>
</nav>

<div class="w-full mb-6 bg-black bg-opacity-90 backdrop-filter backdrop-blur-md hidden lg:block px-4 py-1.5 border-t border-gray-800">
  <div class="flex gap-8 text-sm text-gray-400 max-w-7xl mx-auto justify-center">
    <ul class="flex gap-8 font-normal items-center antialiased">
    
        <!-- TODO SI CLICKEAS "COMPONENTES" DEBERIA DE MOSTRAR TODOS LOS PRODUCTOS DE SUS SUB-CATEGORIAS PERO MUESTRA PAGINA EN BLANCO -->

    <?php while ($cat = $categorias->fetch_assoc()) { 
        $tieneSubcategorias = isset($subcategorias[$cat['id']]) && !empty($subcategorias[$cat['id']]);
    ?>
        <li class="relative group <?php echo $tieneSubcategorias ? 'dropdown-item' : ''; ?>">
            <?php if ($tieneSubcategorias): ?>
                <!--dropdown Template-->
                <form method="POST" action="productos.php" style="display:inline;">
                    <input type="hidden" name="cat" value="<?= $cat['id'] //MENU NAV NORML  ?>">
                    <button class="hover:text-white transition-colors duration-200 py-2 inline-block "
                            style="background:none;border:none;color:inherit;cursor:pointer;font:inherit;">
                        <?= htmlspecialchars($cat['nombre']) ?>
                        <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </form>
                
                <div class="absolute top-full left-0 mt-2 w-48 bg-[#010001] rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 ">
                    <div class="py-2">
                        <?php foreach ($subcategorias[$cat['id']] as $subcat): // SI TIENE SUBCATGORIA -> ?>
                            <form method="POST" action="productos.php" style="display:block;">
                                <input type="hidden" name="cat" value="<?= $subcat['id'] ?>">
                                <button class="w-full text-left px-4 py-2 text-sm text-gray-300  hover:text-white transition-colors duration-150"
                                        style="background:none;border:none;cursor:pointer;font:inherit;">
                                    <?= htmlspecialchars($subcat['nombre']) ?>
                                </button>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <form method="POST" action="productos.php" style="display:inline;">
                    <input type="hidden" name="cat" value="<?= $cat['id'] ?>">
                    <button class="hover:text-white transition-colors duration-200"
                            style="background:none;border:none;color:inherit;cursor:pointer;">
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </button>
                </form>
            <?php endif; ?>
        </li>
    <?php } ?>

    </ul>
  </div>
</div>

<div id="mobile-menu" class="hidden fixed top-0 left-0 w-full h-screen bg-black bg-opacity-95 backdrop-filter backdrop-blur-md z-40 lg:hidden py-10 px-6">
  <div class="flex justify-end mb-8">
    <button id="close-mobile-menu" class="text-white hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <div class="relative w-full mb-6">
    <input type="text" placeholder="Buscar productos..."
      class="w-full pl-10 pr-3 py-2.5 rounded-full bg-gray-800 text-gray-200 placeholder-gray-400 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600" />
    <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  </div>

  <ul class="flex flex-col gap-4 text-white text-lg font-semibold">
    <?php if ($estaLogueado): ?>
      <li class="mb-4 border-b border-gray-700 pb-4">
        <span class="text-gray-400 text-base">Sesión iniciada como:</span>
        <a href="miperfil.php" class="block text-xl font-bold text-white hover:text-gray-300 transition-colors duration-200">
          <?php echo htmlspecialchars($user_display); ?>
        </a>
      </li>
    <?php else: ?>
      <li class="mb-4 border-b border-gray-700 pb-4">
        <a href="cuenta.php" class="block py-2 hover:text-gray-300 transition-colors duration-200">Iniciar Sesión / Cuenta</a>
      </li>
    <?php endif; ?>

    <?php if ($esAdmin): ?>
      <li class="mb-4">
        <a href="admin-panel.php" class="block py-2 text-red-400 hover:text-red-300 transition-colors duration-200 border border-red-400 rounded-lg text-center font-bold">
          Panel de Administración
        </a>
      </li>
    <?php endif; ?>

    <li class="border-t border-gray-700 mt-4 pt-4"></li>
    
    <?php // MOBILE MENU BOTONES
    $categorias->data_seek(0);
    while ($cat = $categorias->fetch_assoc()) { 
        $tieneSubcategorias = isset($subcategorias[$cat['id']]) && !empty($subcategorias[$cat['id']]);
    ?>
        <li class="border-b border-gray-700 pb-2">
            <form method="POST" action="productos.php">
                <input type="hidden" name="cat" value="<?= $cat['id'] ?>">
                <button class="block py-2 hover:text-gray-300 transition-colors duration-200 text-lg font-semibold w-full text-left"
                        style="background:none;border:none;color:inherit;cursor:pointer;">
                    <?= htmlspecialchars($cat['nombre']) // MENU NAV NORMAL MOBILE ?>
                    <?php if ($tieneSubcategorias): ?>
                        <span class="text-gray-400 text-sm ml-2">▼</span>
                    <?php endif; ?>
                </button>
            </form>
            
            <?php if ($tieneSubcategorias): // SI TIENE SUBCATGORIA -> MOIBLE?>
                <ul class="ml-4 mt-2 space-y-1 pb-2">
                    <?php foreach ($subcategorias[$cat['id']] as $subcat): ?>
                        <li>
                            <form method="POST" action="productos.php">
                                <input type="hidden" name="cat" value="<?= $subcat['id'] ?>">
                                <button class="block py-1 text-gray-400 hover:text-white transition-colors duration-200 text-sm w-full text-left"
                                        style="background:none;border:none;color:inherit;cursor:pointer;">
                                    <?= htmlspecialchars($subcat['nombre']) ?>
                                </button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php } ?>
  </ul>
</div>

<script>
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  const closeMobileMenuBtn = document.getElementById("close-mobile-menu");

  function toggleMobileMenu() {
    if (mobileMenu.classList.contains("hidden")) {
      mobileMenu.classList.remove("hidden");
      document.body.style.overflow = "hidden";
    } else {
      mobileMenu.classList.add("hidden");
      document.body.style.overflow = "auto";
    }
  }

  menuBtn.addEventListener("click", toggleMobileMenu);

  closeMobileMenuBtn.addEventListener("click", () => {
    mobileMenu.classList.add("hidden");
    document.body.style.overflow = "auto";
  });
</script>