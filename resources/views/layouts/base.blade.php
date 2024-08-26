<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perfil de Abogada')</title>
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            padding-top: 80px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Componente de Navegación -->
    <nav class="fixed top-0 left-0 right-0 flex items-center justify-between flex-wrap bg-purple-700 p-6 shadow-lg z-50">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8">
                <a href="/"><span class="font-semibold text-xl tracking-tight ml-2">Defensor</span></a>

        </div>
        <div class="block lg:hidden">
            <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-white border-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden" id="nav-content">
            <div class="text-sm lg:flex-grow">
                @auth
                    @if (auth()->user()->roles->isNotEmpty())
                        <a href="{{ route('casos.index') }}"
                            class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                            Casos
                        </a>
                        <a href="{{ route('requisitos.index') }}"
                            class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                            Requisitos
                        </a>
                        <a href="{{ route('tareas.index') }}"
                            class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                            Tareas
                        </a>
                        <a href="{{ route('listas_requisitos.index') }}"
                            class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300">
                            Listas de Requisitos
                        </a>
                    @else
                        <a href="{{ route('casos.index') }}"
                            class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                            Mis Casos
                        </a>
                        <a href="{{ route('requisitos.index') }}"
                            class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                            Mis Requisitos
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300">
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
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nav-toggle').addEventListener('click', function() {
            var navContent = document.getElementById('nav-content');
            if (navContent.classList.contains('hidden')) {
                navContent.classList.remove('hidden');
                navContent.classList.add('block');
            } else {
                navContent.classList.add('hidden');
                navContent.classList.remove('block');
            }
        });
    </script>
</body>

</html>
