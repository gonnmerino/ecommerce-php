<?php
require_once __DIR__ . '/config.php';
require_once INCLUDES_PATH . 'header.php';
?>

<body class="bg-neutral-950 text-neutral-300 flex items-center justify-center min-h-screen px-6">
  <div class="text-center">

    <div class="mb-8">
      <svg class="w-28 h-28 mx-auto text-neutral-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
          d="M12 9v3m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 17c-.77 1.333.192 3 1.732 3z" />
      </svg>
    </div>
    <h1 class="text-3xl sm:text-4xl font-semibold text-white tracking-wide">
      Estamos trabajando en esto
    </h1>
    <p class="text-neutral-400 mt-4 max-w-md mx-auto">
      Esta sección aún no está disponible. Estamos mejorando el sitio para ofrecerte la mejor experiencia.
    </p>
    <button onclick="location.href='<?php echo BASE_URL; ?>index.php'"
      class="mt-8 inline-block px-8 py-3 cursor-pointer rounded-md bg-neutral-800 hover:bg-white hover:text-black 
              transition-all duration-300 font-medium tracking-wide">
      Volver al inicio
    </button>
    <a target="_blank" href=" https://youtu.be/8KiYj1NrmiI?si=Itg5II2L5t2PR7ap">
      <video class="w-100 my-10 m-auto rounded-lg" autoplay muted loop>
        <source src="/src/images/Video.webm" type="video/webm">
      </video>
    </a>
  </div>
</body>

<!--
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

-->