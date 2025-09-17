<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="./src/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="min-h-screen bg-black">
        <div class="min-w-screen bg-red-400 flex items-center justify-center px-3 h-7">
            <img class="w-6 h-6 mr-2" src="src/images/delivery-truck.png" alt="">
            <h3 class="flex-1 text-center text-sm font-bold tracking-wide text-gray-800 max-w-fit sm: text-[12px]">
                Envios gratis a todo el pais!
            </h3>
        </div>
        <nav class="mx-auto max-w-screen-xl px-4 py-3 lg:px-8">
            <!-- Fila 1: Logo + Buscador -->
            <div class="flex items-center justify-between lg:justify-start gap-4">
                <!-- Logo -->
                <a href="#" class="font-semibold text-4xl text-white">
                    Ecommerce
                </a>

                <!-- Buscador centrado -->
                <div class="flex-1 hidden pt-2 lg:flex justify-center -ml-50"> <!--todo Averiguar por que no funciona el fit content, choca con el h1-->
                    <div class="relative w-full max-w-md">                     <!--todo Averiguar por que no funciona el fit content, choca con el h1-->
                        <input type="text" placeholder="Buscar..."
                            class="w-full pl-9 pr-3 py-2 rounded-lg bg-gray-800 text-gray-200 placeholder-gray-400 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600" />
                        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                            <path d="M9.97811 7.95252C10.2126 7.38634 10.3333 6.7795 10.3333 6.16667C10.3333 4.92899 9.84167 3.742 8.9665 2.86683C8.09133 1.99167 6.90434 1.5 5.66667 1.5C4.42899 1.5 3.242 1.99167 2.36683 2.86683C1.49167 3.742 1 4.92899 1 6.16667C1 6.7795 1.12071 7.38634 1.35523 7.95252C1.58975 8.51871 1.93349 9.03316 2.36683 9.4665C2.80018 9.89984 3.31462 10.2436 3.88081 10.4781C4.447 10.7126 5.05383 10.8333 5.66667 10.8333C6.2795 10.8333 6.88634 10.7126 7.45252 10.4781C8.01871 10.2436 8.53316 9.89984 8.9665 9.4665C9.39984 9.03316 9.74358 8.51871 9.97811 7.95252Z" fill="currentColor" />
                            <path d="M13 13.5L9 9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <!-- Botón menú mobile -->
                <button id="menu-btn" class="lg:hidden p-2 rounded-md text-gray-300 hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Fila 2: Links -->
            <div class="mt-4 hidden lg:flex justify-center pt-2">
                <ul class="flex gap-8 text-gray-300 font-medium">
                    <li><a href="#" class="hover:text-white">Componentes</a></li>
                    <li><a href="#" class="hover:text-white">Ofertas</a></li>
                    <li><a href="#" class="hover:text-white">Notebooks</a></li>
                    <li><a href="#" class="hover:text-white">PC Armadas</a></li>
                    <li><a href="#" class="hover:text-white">Monitores</a></li>
                    <li><a href="#" class="hover:text-white">Perifericos</a></li>
                    <li><a href="#" class="hover:text-white">Carrito</a></li>   <!--todo Este mover a otra lista a parte-->
                    <li><a href="#" class="hover:text-white">Cuenta</a></li>    <!--todo Este mover a otra lista a parte-->
                </ul>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden mt-4 lg:hidden">
                <!-- Buscador -->
                <div class="relative w-full mb-4">
                    <input type="text" placeholder="Buscar..."
                        class="w-full pl-9 pr-3 py-2 rounded-lg bg-gray-800 text-gray-200 placeholder-gray-400 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600" />
                    <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                        <path d="M9.97811 7.95252C10.2126 7.38634 10.3333 6.7795 10.3333 6.16667C10.3333 4.92899 9.84167 3.742 8.9665 2.86683C8.09133 1.99167 6.90434 1.5 5.66667 1.5C4.42899 1.5 3.242 1.99167 2.36683 2.86683C1.49167 3.742 1 4.92899 1 6.16667C1 6.7795 1.12071 7.38634 1.35523 7.95252C1.58975 8.51871 1.93349 9.03316 2.36683 9.4665C2.80018 9.89984 3.31462 10.2436 3.88081 10.4781C4.447 10.7126 5.05383 10.8333 5.66667 10.8333C6.2795 10.8333 6.88634 10.7126 7.45252 10.4781C8.01871 10.2436 8.53316 9.89984 8.9665 9.4665C9.39984 9.03316 9.74358 8.51871 9.97811 7.95252Z" fill="currentColor" />
                        <path d="M13 13.5L9 9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Links -->
                <ul class="flex flex-col gap-3 text-gray-300 font-medium">
                    <li><a href="#" class="hover:text-white">Componentes</a></li>
                    <li><a href="#" class="hover:text-white">Ofertas</a></li>
                    <li><a href="#" class="hover:text-white">Notebooks</a></li>
                    <li><a href="#" class="hover:text-white">PC Armadas</a></li>
                    <li><a href="#" class="hover:text-white">Monitores</a></li>
                    <li><a href="#" class="hover:text-white">Perifericos</a></li>
                    <li><a href="#" class="hover:text-white">Carrito</a></li> <!--todo Este mover a otra lista a parte-->
                    <li><a href="#" class="hover:text-white">Cuenta</a></li>  <!--todo Este mover a otra lista a parte-->
                </ul>
            </div>
        </nav>

        <script>
            const menuBtn = document.getElementById("menu-btn");
            const mobileMenu = document.getElementById("mobile-menu");
            menuBtn.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
            });
        </script>


    </div>
</body>

</html>