@extends('layouts.base')

@section('title', 'Perfil de Abogada')

@section('content')
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
@endsection
