<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Auth::user()->mascotas()->get();
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        return view('mascotas.create');
    }

    // ===================== MÉTODOS PÚBLICOS PARA TODOS LOS USUARIOS =====================
    
    /**
     * Mostrar todas las mascotas perdidas (público)
     */
    public function perdidasPublic(Request $request)
    {
        $query = Mascota::where('estado', 'perdida')->with('user');
        $query = $this->aplicarFiltros($query, $request);
        $mascotas = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('mascotas.perdidas.index', compact('mascotas'));
    }

    /**
     * Mostrar todas las mascotas encontradas (público)
     */
    public function encontradasPublic(Request $request)
    {
        $query = Mascota::where('estado', 'encontrada')->with('user');
        $query = $this->aplicarFiltros($query, $request);
        $mascotas = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('mascotas.encontradas.index', compact('mascotas'));
    }

    /**
     * Mostrar todas las mascotas en adopción (público)
     */
    public function adopcionPublic(Request $request)
    {
        $query = Mascota::where('estado', 'adopcion')->with('user');
        $query = $this->aplicarFiltros($query, $request);
        $mascotas = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('mascotas.adopcion.index', compact('mascotas'));
    }

    /**
     * Mostrar detalles públicos de una mascota perdida
     */
    public function showPublic(Mascota $mascota)
    {
        // Verificar que la mascota esté perdida
        if ($mascota->estado !== 'perdida') {
            abort(404, 'Mascota no encontrada o no está reportada como perdida');
        }
        
        return view('mascotas.perdidas.show', compact('mascota'))->with('isPublic', true);
    }

    /**
     * Mostrar detalles públicos de una mascota encontrada
     */
    public function showEncontradaPublic(Mascota $mascota)
    {
        // Verificar que la mascota esté encontrada
        if ($mascota->estado !== 'encontrada') {
            abort(404, 'Mascota no encontrada o no está reportada como encontrada');
        }
        
        return view('mascotas.encontradas.show', compact('mascota'))->with('isPublic', true);
    }

    /**
     * Mostrar detalles públicos de una mascota en adopción
     */
    public function showAdopcionPublic(Mascota $mascota)
    {
        // Verificar que la mascota esté en adopción
        if ($mascota->estado !== 'adopcion') {
            abort(404, 'Mascota no encontrada o no está disponible para adopción');
        }
        
        return view('mascotas.adopcion.show', compact('mascota'))->with('isPublic', true);
    }

    // ===================== MÉTODOS PRIVADOS PARA USUARIOS AUTENTICADOS =====================
    
    public function perdidas()
    {
        $mascotas = Auth::user()->mascotas()->where('estado', 'perdida')->get();
        return view('user.mascotas.perdidas', compact('mascotas'));
    }

    public function encontradas()
    {
        $mascotas = Auth::user()->mascotas()->where('estado', 'encontrada')->get();
        return view('user.mascotas.encontradas', compact('mascotas'));
    }

    public function adopcion()
    {
        $mascotas = Auth::user()->mascotas()->where('estado', 'adopcion')->get();
        return view('user.mascotas.adopcion', compact('mascotas'));
    }

    // ===================== MÉTODOS NUEVOS PARA RUTAS PROTEGIDAS =====================

    /**
     * Mostrar formulario para crear mascota perdida
     */
    public function createPerdida()
    {
        return view('mascotas.create-perdida');
    }

    /**
     * Mostrar formulario para crear mascota encontrada
     */
    public function createEncontrada()
    {
        return view('mascotas.create-encontrada');
    }

    /**
     * Mostrar formulario para crear mascota en adopción
     */
    public function createAdopcion()
    {
        return view('mascotas.create-adopcion');
    }

    /**
     * Mostrar formulario para reportar una mascota
     */
    public function reportar(Mascota $mascota)
    {
        return view('mascotas.reportar', compact('mascota'));
    }

    /**
     * Redirigir al formulario de contacto
     */
    public function contactar(Mascota $mascota)
    {
        // Verificar que el usuario no sea el dueño
        if (Auth::check() && Auth::id() === $mascota->user_id) {
            return redirect()->back()->with('error', 'No puedes contactarte contigo mismo.');
        }

        // Redirigir al sistema de contacto original
        return redirect()->route('contactar.create', $mascota);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'  => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza'    => 'nullable|string|max:255',
            'edad'    => 'nullable|integer|min:0',
            'sexo'    => 'nullable|string|max:10',
            'color'   => 'nullable|string|max:100',
            'tamaño'  => 'nullable|string|max:50',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado'  => 'required|in:perdida,encontrada,adopcion',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mascotas', 'public');
        }

        Auth::user()->mascotas()->create($data);

        return redirect()->route('user.mascotas.index')
                         ->with('success', 'Mascota registrada con éxito.');
    }

    // MÉTODO PARA USUARIOS LOGUEADOS (PROTEGIDO)
    public function show(Mascota $mascota)
    {
        $this->verificarPropiedad($mascota);
        return view('mascotas.show', compact('mascota'));
    }

    public function edit(Mascota $mascota)
    {
        $this->verificarPropiedad($mascota);
        return view('mascotas.edit', compact('mascota'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        $this->verificarPropiedad($mascota);

        $validated = $request->validate([
            'nombre'  => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza'    => 'nullable|string|max:255',
            'edad'    => 'nullable|integer|min:0',
            'sexo'    => 'nullable|string|max:10',
            'color'   => 'nullable|string|max:100',
            'tamaño'  => 'nullable|string|max:50',
            'ubicacion' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado'  => 'required|in:perdida,encontrada,adopcion',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        return redirect()->route('user.mascotas.index')
                         ->with('success', 'Mascota actualizada con éxito.');
    }

    public function destroy(Mascota $mascota)
    {
        $this->verificarPropiedad($mascota);

        // Eliminar foto si existe
        if ($mascota->foto) {
            Storage::disk('public')->delete($mascota->foto);
        }

        $mascota->delete();

        return redirect()->route('user.mascotas.index')
                         ->with('success', 'Mascota eliminada con éxito.');
    }

    /**
     * Aplica filtros comunes a las consultas de mascotas
     */
    private function aplicarFiltros($query, Request $request)
    {
        // Filtro por especie
        if ($request->has('especie') && $request->especie) {
            $query->where('especie', $request->especie);
        }

        // Filtro por ubicación
        if ($request->has('ubicacion') && $request->ubicacion) {
            $query->where('ubicacion', 'like', '%' . $request->ubicacion . '%');
        }

        // Filtro por raza
        if ($request->has('raza') && $request->raza) {
            $query->where('raza', 'like', '%' . $request->raza . '%');
        }

        return $query;
    }

    /**
     * Verifica que la mascota pertenece al usuario actual
     */
    private function verificarPropiedad(Mascota $mascota)
    {
        if ($mascota->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
    }
}