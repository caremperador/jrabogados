@extends('layouts.base')

@section('title', 'Editar Usuario')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Editar Usuario</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Teléfono WhatsApp -->
            <div>
                <label for="telefono_whatsapp" class="block text-sm font-medium text-gray-700">Teléfono WhatsApp</label>
                <input type="text" name="telefono_whatsapp" id="telefono_whatsapp" value="{{ old('telefono_whatsapp', $user->telefono_whatsapp) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Edad -->
            <div>
                <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                <input type="number" name="edad" id="edad" value="{{ old('edad', $user->edad) }}" min="0"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Sexo -->
            <div>
                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select name="sexo" id="sexo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="masculino" {{ $user->sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ $user->sexo == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="no_sexo" {{ $user->sexo == 'no_sexo' ? 'selected' : '' }}>No especificado</option>
                </select>
            </div>

            <!-- País -->
            <div>
                <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                <input type="text" name="pais" id="pais" value="{{ old('pais', $user->pais) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Rol -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Sin Rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-500">
                Actualizar Usuario
            </button>
        </div>
    </form>
@endsection
