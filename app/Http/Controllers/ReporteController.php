<?php
namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with('mascota')->where('user_id', Auth::id())->latest()->get();
        return view('user.reportes.index', compact('reportes'));
    }

    public function create(Request $request)
{
    $mascota_id = $request->query('mascota_id'); // si viene desde "Ver mascota"
    $mascotas = Auth::user()->mascotas;

    return view('user.reportes.create', compact('mascotas', 'mascota_id'));
}


    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'estado'     => 'required|in:perdida,encontrada,adopcion',
            'ubicacion'  => 'required|string|max:255',
            'sexo'       => 'nullable|string',
            'edad'       => 'nullable|string',
            'raza'       => 'nullable|string',
            'color'      => 'nullable|string',
            'fecha'      => 'required|date',
            'descripcion'=> 'nullable|string',
            'foto'       => 'nullable|image|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('reportes', 'public');
        }

        Reporte::create([
            'user_id'    => Auth::id(),
            'mascota_id' => $request->mascota_id,
            'estado'     => $request->estado,
            'ubicacion'  => $request->ubicacion,
            'sexo'       => $request->sexo,
            'edad'       => $request->edad,
            'raza'       => $request->raza,
            'color'      => $request->color,
            'fecha'      => $request->fecha,
            'descripcion'=> $request->descripcion,
            'foto'       => $fotoPath,
        ]);

        return redirect()->route('user.reportes.index')->with('success', 'Reporte creado correctamente.');
    }

    public function show(Reporte $reporte)
{
    $this->authorize('view', $reporte); // opcional si usas policies
    $reporte->load('mascota', 'user');
    return view('user.reportes.show', compact('reporte'));
}

}
