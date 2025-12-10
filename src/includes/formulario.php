<form method="POST" action="" id="form"
  class="max-w-sm mx-auto mt-20 bg-black/80 backdrop-blur-xl p-8 rounded-2xl 
             shadow-xl border border-white/10">

  <h2 id="form-title" class="text-3xl font-light text-white mb-8 text-center tracking-wide">
    Crear cuenta
  </h2>

  <div class="mb-6">
    <label for="email" class="block mb-1 text-sm font-medium text-gray-300">
      Correo
    </label>
    <input
      type="email" name="email" id="email"
      class="w-full px-3 py-3 text-white bg-black border border-white/10 
                   rounded-xl focus:outline-none focus:border-white/30 
                   transition-all duration-300"
      placeholder="tunombre@correo.com" required />
  </div>

  <div class="mb-6">
    <label for="password" class="block mb-1 text-sm font-medium text-gray-300">
      Contraseña
    </label>
    <input
      type="password" name="password" id="password"
      class="w-full px-3 py-3 text-white bg-black border border-white/10 
                   rounded-xl focus:outline-none focus:border-white/30 
                   transition-all duration-300"
      required />
  </div>

  <div id="repeat-password-container" class="mb-6">
    <label for="repeat-password-input" class="block mb-1 text-sm font-medium text-gray-300">
      Repetí contraseña
    </label>
    <input
      type="password" name="repeat-password" id="repeat-password-input"
      class="w-full px-3 py-3 text-white bg-black border border-white/10 
                   rounded-xl focus:outline-none focus:border-white/30 
                   transition-all duration-300"
      required />
  </div>

  <div class="flex flex-row items-center justify-center mb-6">
    <span id="switch-text" class="text-sm text-gray-400 mr-1">
      ¿Tenés cuenta?
    </span>
    <a id="switch-mode" role="button"
      class="cursor-pointer text-sm font-medium text-gray-200 hover:text-white 
                  underline-offset-4 hover:underline transition">
      Entrá acá
    </a>
  </div>

  <div id="terms-container" class="flex items-start mb-6">
    <input id="terms" type="checkbox"
      class="w-4 h-4 bg-black border border-white/20 rounded 
                      focus:ring-white/20 checked:bg-white/20" required>

    <label for="terms" class="ms-2 text-sm font-medium text-gray-300">
      Acepto los
      <a href="#" class="text-white hover:underline transition">
        términos y condiciones
      </a>
    </label>
  </div>

  <button type="submit" id="submit-btn"
    class="w-full py-3 rounded-xl text-white cursor-pointer bg-white/5 border border-white/10
                   hover:bg-white/10 hover:border-white/20 transition-all duration-300
                   font-medium">
    Registrarse
  </button>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
    const submitBtn = document.getElementById('submit-btn');
    const switchMode = document.getElementById('switch-mode')
    const switchText = document.getElementById('switch-text');
    const repeatPasswordContainer = document.getElementById('repeat-password-container');
    const repeatPasswordInput = document.getElementById('repeat-password-input');
    const termsContainer = document.getElementById('terms-container');
    const termsCheckBox = document.getElementById('terms');
    const formTitle = document.getElementById('form-title');

    let isLoginMode = true; 

    function toggleMode() {
      isLoginMode = !isLoginMode;

      if (isLoginMode) {
        submitBtn.textContent = 'Ingresar';
        switchText.textContent = '¿No tenes cuenta?';
        switchMode.textContent = '¡Registrate acá!';
        formTitle.textContent = 'Ingresar';

        repeatPasswordContainer.classList.add('hidden');
        termsContainer.classList.add('hidden');

        repeatPasswordInput.removeAttribute('required');
        termsCheckBox.removeAttribute('required');

        form.action = 'src/includes/login_usuario.php';

      } else {
        submitBtn.textContent = 'Crear cuenta';
        switchText.textContent = '¿Ya tenes cuenta?';
        switchMode.textContent = '¡Entra acá!';
        formTitle.textContent = 'Crear cuenta';
        repeatPasswordContainer.classList.remove('hidden');
        termsContainer.classList.remove('hidden');

        repeatPasswordInput.setAttribute('required', 'required');
        termsCheckBox.setAttribute('required', 'required');

        form.action = 'src/includes/registrar_usuario.php';
      }
    }
    toggleMode();
    toggleMode();
    switchMode.addEventListener('click', toggleMode);

    form.addEventListener('submit', function(e) {
      if (!isLoginMode) {
        const password = document.getElementById('password').value;
        const repeatPassword = document.getElementById('repeat-password-input').value;

        if (password != repeatPassword) {
          e.preventDefault();
          alert('Las contraseñas no coinciden');
          return;
        };
      };
    });
  });
</script>