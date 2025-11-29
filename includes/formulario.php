<form method="POST" action="" id="form" class="max-w-sm mx-auto mt-25">
    <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
        <input type="email" name="email" id="email" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" placeholder="tunombre@correo.com" required />
    </div>
    <div class="mb-5">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
        <input type="password" name="password" id="password" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" required />
    </div>
    <div id="repeat-password-container" class="mb-5">
        <label for="repeat-password-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repetí contraseña</label>
        <input type="password" name="repeat-password" id="repeat-password-input" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" required />
    </div>
    <div class="flex flex-row items-center mb-5 -mt-2">
        <span id="switch-text" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 mr-1">¿Tenes cuenta? </span>
        <a id="switch-mode" role="button" class="cursor-pointer block text-sm font-medium text-blue-600 hover:blue-300 dark:text-blue-500 hover:underline"> Entra acá</a>
    </div>
    <div id="terms-container" class="flex items-start mb-4">
        <div class="flex items-center h-5">
            <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
        </div>
        <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Acepto los <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terminos y condiciones</a></label>
    </div>
    <button type="submit" id="submit-btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrarse</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form');
        const submitBtn = document.getElementById('submit-btn');
        const switchMode = document.getElementById('switch-mode')
        const switchText = document.getElementById('switch-text');
        const repeatPasswordContainer =document.getElementById('repeat-password-container');
        const repeatPasswordInput = document.getElementById('repeat-password-input');
        const termsContainer = document.getElementById('terms-container');
        const termsCheckBox= document.getElementById('terms');

        let isLoginMode = true;
        
        function toggleMode() {
            isLoginMode = !isLoginMode;

            if(isLoginMode) {
                submitBtn.textContent = 'Ingresar';
                switchText.textContent = '¿No tenes cuenta?';
                switchMode.textContent =  '¡Registrate acá!';

                //Oculta los botones que no son para login
                repeatPasswordContainer.classList.add('hidden');
                termsContainer.classList.add('hidden');

                //Quita la obligacion de repetir contraseña y aceptar terminos
                repeatPasswordInput.removeAttribute('required');
                termsCheckBox.removeAttribute('required');

                form.action = 'includes/login_usuario.php';
        
            } else { //Modo registro
                submitBtn.textContent = 'Crear cuenta';
                switchText.textContent = '¿Ya tenes cuenta?';
                switchMode.textContent =  '¡Entra acá!';

                repeatPasswordContainer.classList.remove('hidden');
                termsContainer.classList.remove('hidden');

                repeatPasswordInput.setAttribute('required', 'required');
                termsCheckBox.setAttribute('required', 'required');

                form.action = 'includes/registrar_usuario.php';
            }
        }
        toggleMode();
        toggleMode();
        switchMode.addEventListener('click', toggleMode);

        form.addEventListener('submit', function(e) {
            if(!isLoginMode) {
                const password = document.getElementById('password').value;
                const repeatPassword = document.getElementById('repeat-password-input').value;

                if(password != repeatPassword) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden');
                    return;
                };
            };
        });
    });
</script>

