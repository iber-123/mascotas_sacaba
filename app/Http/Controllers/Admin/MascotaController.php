<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    /**
     * Mostrar todas las mascotas (admin)
     */
    public function index()
    {
        $mascotas = Mascota::with('user')->latest()->paginate(10);
        return view('admin.mascotas.index', compact('mascotas'));
    }

    /**
     * Mostrar formulario para crear mascota (admin)
     */
    public function create()
    {
        $users = User::all();
        return view('admin.mascotas.create', compact('users'));
    }

    /**
     * Guardar nueva mascota (admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'sexo' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:100',
            'tamaño' => 'nullable|string|max:50',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:perdida,encontrada,adopcion',
            'user_id' => 'required|exists:users,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mascotas', 'public');
        }

        Mascota::create($data);

        return redirect()->route('admin.mascotas.index')
                         ->with('success', 'Mascota registrada con éxito.');
    }

    /**
     * Mostrar detalles de mascota (admin)
     */
    public function show(Mascota $mascota)
    {
        return view('admin.mascotas.show', compact('mascota'));
    }

    /**
     * Mostrar formulario para editar mascota (admin)
     */
    public function edit(Mascota $mascota)
    {
        $users = User::all();
        return view('admin.mascotas.edit', compact('mascota', 'users'));
    }

    /**
     * Actualizar mascota (admin)
     */
    public function update(Request $request, Mascota $mascota)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'sexo' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:100',
            'tamaño' => 'nullable|string|max:50',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:perdida,encontrada,adopcion',
            'user_id' => 'required|exists:users,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($mascota->foto) {
                Storage::disk('public')->delete($mascota->foto);
            }
            $data['foto'] = $request->file('foto')->store('mascotas', 'public');
        }

        $mascota->update($data);

        return redirect()->route('admin.mascotas.index')
                         ->with('success', 'Mascota actualizada con éxito.');
    }

    /**
     * Eliminar mascota (admin)
     */
    public function destroy(Mascota $mascota)
    {
        // Eliminar foto si existe
        if ($mascota->foto) {
            Storage::disk('public')->delete($mascota->foto);
        }

        $mascota->delete();

        return redirect()->route('admin.mascotas.index')
                         ->with('success', 'Mascota eliminada con éxito.');
    }
}