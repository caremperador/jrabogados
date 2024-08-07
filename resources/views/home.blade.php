<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Abogada</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Añadir margen superior al contenido para que no se superponga con el navbar */
        body {
            padding-top: 80px; /* Ajusta este valor según la altura de tu navbar */
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Componente de Navegación -->
    <nav class="fixed top-0 left-0 right-0 flex items-center justify-between flex-wrap bg-purple-700 p-6 shadow-lg z-50">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
            <span class="font-semibold text-xl tracking-tight ml-2">Defensor</span>
        </div>
        <div class="block lg:hidden">
            <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-white border-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden" id="nav-content">
            <div class="text-sm lg:flex-grow">
                @auth
                    <a href="{{ route('casos.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                        Mis Casos
                    </a>
                    <a href="{{ route('requisitos.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                        Mis Requisitos
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-8 rounded-lg shadow-2xl flex flex-col items-center md:flex-row md:items-start md:space-x-8">
                            <div class="flex-shrink-0">
                                <img class="rounded-full border-4 border-purple-700" src="{{ asset('images/perfil.jpeg') }}" alt="Jannet Rivero Pedemonte" width="350" height="350" />
                            </div>
                            <div class="mt-6 md:mt-0 max-w-lg text-center md:text-left">
                                <h2 class="text-purple-700 font-bold uppercase text-2xl">Jannet Rivero Pedemonte</h2>
                                <h1 class="text-4xl font-extrabold text-purple-700">Abogada Familiar y Civil</h1>
                                <p class="mt-4 text-black leading-relaxed text-lg">
                                    Hola, soy Jannet, abogada de familia y civil con más de 22 años de experiencia en el campo legal. Me especializo en ofrecer asesoría y representación legal en casos familiares y civiles, ayudando a mis clientes a navegar situaciones legales complejas con confianza y profesionalismo.
                                </p>
                                <p class="mt-4 text-black leading-relaxed text-lg">
                                    Encuéntrame en redes sociales:
                                </p>
                                <div class="flex justify-center md:justify-start space-x-4 mt-4">
                                    <a href="https://www.tiktok.com/@defensor.app" class="text-black hover:text-purple-700 transition-colors">
                                        <i class="fab fa-tiktok fa-2x"></i>
                                    </a>
                                    <a href="https://www.youtube.com/@jannetriveroabogada" class="text-black hover:text-purple-700 transition-colors">
                                        <i class="fab fa-youtube fa-2x"></i>
                                    </a>
                                    <a href="https://www.facebook.com/abogada.jannet.rivero" class="text-black hover:text-purple-700 transition-colors">
                                        <i class="fab fa-facebook fa-2x"></i>
                                    </a>
                                    <a href="https://www.instagram.com/abogadajannetrivero/" class="text-black hover:text-purple-700 transition-colors">
                                        <i class="fab fa-instagram fa-2x"></i>
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-center md:justify-start">
                                    <a href="https://wa.me/51977953291" class="inline-flex items-center bg-purple-700 text-white py-2 px-4 rounded-full hover:bg-purple-800 transition-colors">
                                        <i class="fab fa-whatsapp fa-2x mr-2"></i>
                                        Iniciar una consulta
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nav-toggle').addEventListener('click', function() {
            var navContent = document.getElementById('nav-content');
            if (navContent.classList.contains('hidden')) {
                navContent.classList.remove('hidden');
                navContent.classList.add('block'); // O 'flex' si prefieres que se muestre como flex
            } else {
                navContent.classList.add('hidden');
                navContent.classList.remove('block'); // O 'flex', según lo que hayas elegido
            }
        });
    </script>
</body>
</html>
