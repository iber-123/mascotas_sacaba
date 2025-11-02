<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Reporte;

class WelcomeController extends Controller
{
    // Página principal
    public function index()
    {
        $mascotas = Mascota::with('user')
            ->latest()
            ->take(6)
            ->get();

        $totalMascotas = Mascota::count();
        $mascotasPerdidas = Mascota::where('estado', 'perdida')->count();
        $mascotasEncontradas = Mascota::where('estado', 'encontrada')->count();
        $mascotasAdopcion = Mascota::where('estado', 'adopcion')->count();

        return view('welcome', compact(
            'mascotas',
            'totalMascotas',
            'mascotasPerdidas',
            'mascotasEncontradas',
            'mascotasAdopcion'
        ));
    }

    // Página de búsqueda
   public function buscar(Request $request)
{
    $query = Mascota::with('user');

    // Búsqueda por texto
    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
              ->orWhere('raza', 'like', "%{$search}%")
              ->orWhere('descripcion', 'like', "%{$search}%");
        });
    }

    // Filtros
    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    if ($request->filled('especie')) {
        $query->where('especie', $request->especie);
    }

    if ($request->filled('tamaño')) {
        $query->where('tamaño', $request->tamaño);
    }

    if ($request->filled('color')) {
        $query->where('color', 'like', "%{$request->color}%");
    }

    if ($request->filled('ubicacion')) {
        $query->where('ubicacion', 'like', "%{$request->ubicacion}%");
    }

    $mascotas = $query->orderBy('created_at', 'desc')->paginate(12);

    // VISTA ORIGINAL CON DEBUG
    return view('paginas.buscar', compact('mascotas'));
}
    
}