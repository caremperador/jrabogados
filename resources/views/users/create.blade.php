@extends('layouts.base')

@section('title', 'Crear Usuario')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Usuario</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Teléfono WhatsApp -->
            <div>
                <label for="telefono_whatsapp" class="block text-sm font-medium text-gray-700">Teléfono WhatsApp</label>
                <input type="text" name="telefono_whatsapp" id="telefono_whatsapp"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Edad -->
            <div>
                <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                <input type="number" name="edad" id="edad" min="0"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Sexo -->
            <div>
                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select name="sexo" id="sexo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecciona una opción</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="no_sexo">No especificado</option>
                </select>
            </div>

            <!-- País -->
            <div>
                <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                <input type="text" name="pais" id="pais"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Rol -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Sin Rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                Crear Usuario
            </button>
        </div>
    </form>
@endsection
