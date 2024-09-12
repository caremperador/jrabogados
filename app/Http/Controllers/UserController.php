<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\UsuarioSexoEnum;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']); // Solo administradores pueden acceder
    }

    public function create()
    {
        $roles = Role::all(); // Obtenemos todos los roles
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telefono_whatsapp' => 'nullable|string|max:20',
            'edad' => 'nullable|integer|min:0',
            'sexo' => 'nullable|in:masculino,femenino,no_sexo', // Validar el enum aquí
            'pais' => 'nullable|string|max:100',
            'role' => 'nullable|exists:roles,name', // Validar que el rol exista
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono_whatsapp' => $request->telefono_whatsapp,
            'edad' => $request->edad,
            'sexo' => UsuarioSexoEnum::tryFrom($request->sexo), // Casteo con el enum
            'pais' => $request->pais,
        ]);

        // Asignar el rol si el usuario selecciona uno
        if ($request->filled('role')) {
            $user->assignRole($request->role);
        }

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }
    public function index(Request $request)
    {
        // Filtrar por nombre o email
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10); // Paginación

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Obtenemos todos los roles
        return view('users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telefono_whatsapp' => 'nullable|string|max:20',
            'edad' => 'nullable|integer|min:0',
            'sexo' => 'nullable|in:masculino,femenino,no_sexo',
            'pais' => 'nullable|string|max:100',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
