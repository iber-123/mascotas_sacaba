<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    public function create(Mascota $mascota)
    {
        // Verificar que el usuario no sea el dueño
        if (Auth::check() && Auth::id() === $mascota->user_id) {
            return redirect()->back()->with('error', 'No puedes contactarte contigo mismo.');
        }

        return view('contacto.create', compact('mascota'));
    }

    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string|max:20',
            'mensaje' => 'required|string|min:10',
        ]);

        $mascota = Mascota::findOrFail($request->mascota_id);
        
        // Verificar que el usuario no sea el dueño
        if (Auth::check() && Auth::id() === $mascota->user_id) {
            return redirect()->back()->with('error', 'No puedes contactarte contigo mismo.');
        }

        // Determinar el tipo de contacto según el estado de la mascota
        $tipo = match($mascota->estado) {
            'perdida' => 'reclamo',
            'encontrada' => 'hogar_temporal',
            'adopcion' => 'adopcion',
            default => 'consulta'
        };

        // Crear el contacto
        Contacto::create([
            'mascota_id' => $mascota->id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'dueño_id' => $mascota->user_id,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'mensaje' => $request->mensaje,
            'tipo' => $tipo,
            'leido' => false
        ]);

        // Redirigir según el tipo de mascota
        $ruta = match($mascota->estado) {
            'perdida' => 'mascotas.perdidas.show',
            'encontrada' => 'mascotas.encontradas.show', 
            'adopcion' => 'mascotas.adopcion.show',
            default => 'inicio'
        };

        return redirect()->route($ruta, $mascota)
            ->with('success', 'Mensaje enviado correctamente. El dueño se pondrá en contacto contigo.');
    }

    // Método para que los dueños vean sus mensajes
    public function index()
    {
        $mensajes = Contacto::where('dueño_id', Auth::id())
            ->with(['mascota', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('contacto.index', compact('mensajes'));
    }

    // Marcar mensaje como leído
    public function marcarLeido(Contacto $contacto)
    {
        // Verificar que el usuario es el dueño
        if ($contacto->dueño_id !== Auth::id()) {
            abort(403);
        }

        $contacto->update(['leido' => true]);

        return response()->json(['success' => true]);
    }
}