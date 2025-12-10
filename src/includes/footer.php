<?php
require_once __DIR__ . '/../../config.php';
?>
<footer class="bg-neutral-950 text-neutral-300 border-t border-neutral-800">
  <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

    <div>
      <div class="flex flex-row">
        <img class="max-w-6 max-h-5 my-auto mr-1" src="favicon.png">
        <h2 class="text-xl font-semibold text-white tracking-wide">ECOMMERCE</h2>
      </div>
      <p class="mt-4 text-sm text-neutral-400">
        Componentes de PC de alta calidad. Rendimiento, innovación y confianza en cada compra.
      </p>
    </div>

    <div>
      <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Nuestra Empresa</h3>
      <ul class="space-y-3">
        <li><a href="#" class="hover:text-white transition">Sobre nosotros</a></li>
        <li><a href="#" class="hover:text-white transition">Política de privacidad</a></li>
        <li><a href="#" class="hover:text-white transition">Términos y condiciones</a></li>
        <li><a href="#" class="hover:text-white transition">Trabajá con nosotros</a></li>
      </ul>
    </div>

    <div>
      <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Atención al cliente</h3>
      <ul class="space-y-3">
        <li><a href="#" class="hover:text-white transition">Garantía</a></li>
        <li><a href="<?php echo BASE_URL . 'contacto.php' ?>" class="hover:text-white transition">Contacto</a></li>
        <li><a href="#" class="hover:text-white transition">Preguntas frecuentes</a></li>
        <li><a href="#" class="hover:text-white transition">Envíos y devoluciones</a></li>
      </ul>
    </div>

    <div>
      <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Síguenos</h3>
      <div class="flex space-x-6">
        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-facebook"></i> Facebook</a>
        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-instagram"></i> Instagram</a>
        <a href="#" class="hover:text-white transition"><i class="fa-brands fa-x-twitter"></i> X</a>
      </div>
    </div>

  </div>

  <div class="border-t border-neutral-800">
    <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col sm:flex-row justify-between text-sm text-neutral-500">
      <p>© 2025 ECOMMERCE — Todos los derechos reservados</p>
      <div class="flex space-x-6 mt-4 sm:mt-0">
        <a href="#" class="hover:text-white transition">Privacidad</a>
        <a href="#" class="hover:text-white transition">Términos</a>
        <a href="#" class="hover:text-white transition">Ayuda</a>
      </div>
    </div>
  </div>
</footer>