<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'header.php';
?>

<body>
  <div class="flex flex-col overflow-hidden h-screen bg-[#262626] justify-center items-center">
      <h3 class="text-4xl font-medium text-center text-white antialiased">Esta pagina aun no existe.</h3>
      <video class="w-100 my-10 rounded-sm" autoplay muted loop>
        <source src="/src/images/Video.webm" type="video/webm">
      </video>
    <button class="items-center cursor-pointer text-xl p-3 rounded-xl bg-amber-400 hover:bg-amber-300"
      onclick="location.href='<?php echo BASE_URL; ?>index.php'">
      ¡Volver al inicio!
    </button>
  </div>
</body>