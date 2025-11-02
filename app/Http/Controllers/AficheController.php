<?php

namespace App\Http\Controllers;

use App\Models\Afiche;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AficheController extends Controller
{
    public function create()
    {
        $mascotas = Mascota::where('user_id', auth()->id())->get();
        return view('afiches.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'telefono_contacto' => 'required|string|max:20',
            'recompensa' => 'nullable|string|max:100',
            'plantilla' => 'required|in:default,moderno,clasico,urgente',
            'color_principal' => 'required|string',
        ]);

        // Verificar que la mascota pertenece al usuario
        $mascota = Mascota::where('id', $request->mascota_id)
                         ->where('user_id', auth()->id())
                         ->firstOrFail();

        Afiche::create([
            'user_id' => auth()->id(),
            'mascota_id' => $request->mascota_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'telefono_contacto' => $request->telefono_contacto,
            'recompensa' => $request->recompensa,
            'plantilla' => $request->plantilla,
            'color_principal' => $request->color_principal,
            'mostrar_recompensa' => $request->has('mostrar_recompensa'),
            'mostrar_contacto' => $request->has('mostrar_contacto'),
        ]);

        return redirect()->route('afiches.index')
            ->with('success', 'Afiche creado correctamente. Ahora puedes descargarlo en PDF o Imagen.');
    }

    public function downloadPDF(Afiche $afiche)
    {
        if ($afiche->user_id !== auth()->id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('afiches.pdf', compact('afiche'));
        return $pdf->download('afiche-' . $afiche->mascota->nombre . '.pdf');
    }

    public function downloadImage(Afiche $afiche)
    {
        if ($afiche->user_id !== auth()->id()) {
            abort(403);
        }

        return view('afiches.image', compact('afiche'));
    }

    public function index()
    {
        $afiches = Afiche::where('user_id', auth()->id())
                        ->with('mascota')
                        ->latest()
                        ->get();
        return view('afiches.index', compact('afiches'));
    }
}