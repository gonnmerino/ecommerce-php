<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'session.php';
require_once INCLUDES_PATH . 'header.php';
require_once INCLUDES_PATH . 'conexion.php';
?>

<body>
  <div class="min-h-screen">
    <?php
    include INCLUDES_PATH . 'nav.php';
    ?>

    <div class="min-h-screen bg-neutral-950 flex items-center justify-center px-6 py-20">
      <div class="w-full max-w-md bg-neutral-900 p-8 rounded-xl border border-neutral-800 shadow-lg">

        <h1 class="text-2xl font-semibold text-white text-center mb-6 tracking-wide">
          Contacto
        </h1>

        <p class="text-neutral-400 text-center text-sm mb-8">
          Envíanos tu consulta y te responderemos a la brevedad.
        </p>

        <form action="#" method="POST" class="space-y-5">

          <!-- Nombre -->
          <div>
            <label class="block text-sm text-neutral-300 mb-1">Nombre</label>
            <input type="text" name="nombre"
              class="w-full px-4 py-2 rounded-md bg-neutral-800 border border-neutral-700
                      text-neutral-200 focus:border-white focus:outline-none transition">
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm text-neutral-300 mb-1">Email</label>
            <input type="email" name="email"
              class="w-full px-4 py-2 rounded-md bg-neutral-800 border border-neutral-700
                      text-neutral-200 focus:border-white focus:outline-none transition">
          </div>

          <!-- Mensaje -->
          <div>
            <label class="block text-sm text-neutral-300 mb-1">Mensaje</label>
            <textarea name="mensaje" rows="4"
              class="w-full px-4 py-2 rounded-md bg-neutral-800 border border-neutral-700
                         text-neutral-200 focus:border-white focus:outline-none transition"></textarea>
          </div>

          <!-- Botón -->
          <button type="submit"
            class="w-full py-2.5 bg-white text-black rounded-md font-medium
                     hover:bg-neutral-200 transition">
            Enviar mensaje
          </button>

        </form>

      </div>
    </div>

  </div>
  <?php
    include INCLUDES_PATH . 'footer.php';
  ?>
</body>