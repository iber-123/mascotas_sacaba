<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with(['mascota', 'user'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
        
        // Estadísticas para los reportes estadísticos
        $estadisticas = [
            'total_usuarios' => User::count(),
            'total_mascotas' => Mascota::count(),
            'mascotas_perdidas' => Mascota::where('estado', 'perdida')->count(),
            'mascotas_encontradas' => Mascota::where('estado', 'encontrada')->count(),
            'mascotas_adopcion' => Mascota::where('estado', 'adopcion')->count(),
        ];
        
        return view('admin.reportes.index', compact('reportes', 'estadisticas'));
    }

    public function create()
    {
        // No necesitamos create para admin generalmente
        return redirect()->route('admin.reportes.index');
    }

    public function store(Request $request)
    {
        // Los reportes se crean desde el lado del usuario
        return redirect()->route('admin.reportes.index');
    }

    public function show(Reporte $reporte)
    {
        $reporte->load(['mascota', 'user']);
        return view('admin.reportes.show', compact('reporte'));
    }

    public function edit(Reporte $reporte)
    {
        // Usamos show para editar también
        return redirect()->route('admin.reportes.show', $reporte);
    }

    public function update(Request $request, Reporte $reporte)
    {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,resuelto',
        ]);

        $reporte->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.reportes.show', $reporte)
                         ->with('success', 'Estado del reporte actualizado correctamente.');
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return redirect()->route('admin.reportes.index')
                         ->with('success', 'Reporte eliminado correctamente.');
    }

    public function getMascotasByUser(User $user)
    {
        $mascotas = $user->mascotas()->get();
        return response()->json($mascotas);
    }

    /**
     * Exportar reportes estadísticos
     */
    public function exportar($tipo, $formato)
    {
        try {
            if ($tipo === 'usuarios') {
                return $this->exportarUsuarios($formato);
            } elseif ($tipo === 'mascotas') {
                return $this->exportarMascotas($formato);
            } elseif ($tipo === 'estadisticas') {
                return $this->exportarEstadisticas($formato);
            } elseif ($tipo === 'mascotas-perdidas') {
                return $this->exportarMascotasPerdidas($formato);
            } elseif ($tipo === 'mascotas-encontradas') {
                return $this->exportarMascotasEncontradas($formato);
            } elseif ($tipo === 'mascotas-adopcion') {
                return $this->exportarMascotasAdopcion($formato);
            }
            
            return redirect()->route('admin.reportes.index')
                           ->with('error', 'Tipo de reporte no válido.');
                           
        } catch (\Exception $e) {
            return redirect()->route('admin.reportes.index')
                           ->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    /**
     * Exportar reporte de usuarios
     */
    private function exportarUsuarios($formato)
    {
        $usuarios = User::withCount('mascotas')->get();
        $totalUsuarios = $usuarios->count();
        $fechaGeneracion = now()->format('d/m/Y H:i');
        
        if ($formato === 'pdf') {
            return $this->generarPdfUsuarios($usuarios, $totalUsuarios, $fechaGeneracion);
        } elseif ($formato === 'excel') {
            return $this->generarExcelUsuarios($usuarios, $totalUsuarios, $fechaGeneracion);
        } elseif ($formato === 'word') {
            return $this->generarWordUsuarios($usuarios, $totalUsuarios, $fechaGeneracion);
        }
        
        // HTML simple para vista previa
        $titulo = "Reporte de Usuarios - {$fechaGeneracion}";
        return view('admin.reportes.export.html-base', compact('usuarios', 'totalUsuarios', 'fechaGeneracion', 'titulo'));
    }

    /**
     * Exportar reporte de mascotas
     */
    private function exportarMascotas($formato)
    {
        $mascotas = Mascota::with('user')->get();
        $estadisticas = [
            'total' => $mascotas->count(),
            'perdidas' => $mascotas->where('estado', 'perdida')->count(),
            'encontradas' => $mascotas->where('estado', 'encontrada')->count(),
            'adopcion' => $mascotas->where('estado', 'adopcion')->count(),
        ];
        $fechaGeneracion = now()->format('d/m/Y H:i');
        
        if ($formato === 'pdf') {
            return $this->generarPdfMascotas($mascotas, $estadisticas, $fechaGeneracion);
        } elseif ($formato === 'excel') {
            return $this->generarExcelMascotas($mascotas, $estadisticas, $fechaGeneracion);
        } elseif ($formato === 'word') {
            return $this->generarWordMascotas($mascotas, $estadisticas, $fechaGeneracion);
        }
        
        $titulo = "Reporte General de Mascotas - {$fechaGeneracion}";
        return view('admin.reportes.export.html-base', compact('mascotas', 'estadisticas', 'fechaGeneracion', 'titulo'));
    }

    /**
     * Exportar mascotas perdidas
     */
    private function exportarMascotasPerdidas($formato)
    {
        $mascotas = Mascota::with('user')->where('estado', 'perdida')->get();
        $total = $mascotas->count();
        $fechaGeneracion = now()->format('d/m/Y H:i');
        
        if ($formato === 'pdf') {
            return $this->generarPdfMascotasEstado($mascotas, 'Perdidas', $total, $fechaGeneracion);
        } elseif ($formato === 'excel') {
            return $this->generarExcelMascotasEstado($mascotas, 'Perdidas', $total, $fechaGeneracion);
        } elseif ($formato === 'word') {
            return $this->generarWordMascotasEstado($mascotas, 'Perdidas', $total, $fechaGeneracion);
        }
        
        $titulo = "Reporte de Mascotas Perdidas - {$fechaGeneracion}";
        return view('admin.reportes.export.html-base', compact('mascotas', 'total', 'fechaGeneracion', 'titulo'));
    }

    /**
     * Exportar mascotas encontradas
     */
    private function exportarMascotasEncontradas($formato)
    {
        $mascotas = Mascota::with('user')->where('estado', 'encontrada')->get();
        $total = $mascotas->count();
        $fechaGeneracion = now()->format('d/m/Y H:i');
        
        if ($formato === 'pdf') {
            return $this->generarPdfMascotasEstado($mascotas, 'Encontradas', $total, $fechaGeneracion);
        } elseif ($formato === 'excel') {
            return $this->generarExcelMascotasEstado($mascotas, 'Encontradas', $total, $fechaGeneracion);
        } elseif ($formato === 'word') {
            return $this->generarWordMascotasEstado($mascotas, 'Encontradas', $total, $fechaGeneracion);
        }
        
        $titulo = "Reporte de Mascotas Encontradas - {$fechaGeneracion}";
        return view('admin.reportes.export.html-base', compact('mascotas', 'total', 'fechaGeneracion', 'titulo'));
    }

    /**
     * Exportar mascotas en adopción
     */
    private function exportarMascotasAdopcion($formato)
    {
        $mascotas = Mascota::with('user')->where('estado', 'adopcion')->get();
        $total = $mascotas->count();
        $fechaGeneracion = now()->format('d/m/Y H:i');
        
        if ($formato === 'pdf') {
            return $this->generarPdfMascotasEstado($mascotas, 'Adopción', $total, $fechaGeneracion);
        } elseif ($formato === 'excel') {
            return $this->generarExcelMascotasEstado($mascotas, 'Adopción', $total, $fechaGeneracion);
        } elseif ($formato === 'word') {
            return $this->generarWordMascotasEstado($mascotas, 'Adopción', $total, $fechaGeneracion);
        }
        
        $titulo = "Reporte de Mascotas en Adopción - {$fechaGeneracion}";
        return view('admin.reportes.export.html-base', compact('mascotas', 'total', 'fechaGeneracion', 'titulo'));
    }

    /**
     * Exportar estadísticas generales
     */
    private function exportarEstadisticas($formato)
    {
        $estadisticas = [
            'total_usuarios' => User::count(),
            'total_mascotas' => Mascota::count(),
            'mascotas_perdidas' => Mascota::where('estado', 'perdida')->count(),
            'mascotas_encontradas' => Mascota::where('estado', 'encontrada')->count(),
            'mascotas_adopcion' => Mascota::where('estado', 'adopcion')->count(),
            'reportes_pendientes' => Reporte::where('estado', 'pendiente')->count(),
            'fecha_generacion' => now()->format('d/m/Y H:i'),
        ];
        
        if ($formato === 'pdf') {
            return $this->generarPdfEstadisticas($estadisticas);
        } elseif ($formato === 'excel') {
            return $this->generarExcelEstadisticas($estadisticas);
        } elseif ($formato === 'word') {
            return $this->generarWordEstadisticas($estadisticas);
        }
        
        $titulo = "Reporte de Estadísticas Generales - {$estadisticas['fecha_generacion']}";
        return view('admin.reportes.export.html-base', compact('estadisticas', 'titulo'));
    }

    // Métodos placeholder para los formatos (implementación básica)
    private function generarPdfUsuarios($usuarios, $total, $fecha) {
        return response("PDF de Usuarios - Total: {$total} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/pdf')
               ->header('Content-Disposition', 'attachment; filename="reporte-usuarios.pdf"');
    }
    
    private function generarExcelUsuarios($usuarios, $total, $fecha) {
        return response("Excel de Usuarios - Total: {$total} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
               ->header('Content-Disposition', 'attachment; filename="reporte-usuarios.xlsx"');
    }
    
    private function generarWordUsuarios($usuarios, $total, $fecha) {
        return response("Word de Usuarios - Total: {$total} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
               ->header('Content-Disposition', 'attachment; filename="reporte-usuarios.docx"');
    }
    
    private function generarPdfMascotas($mascotas, $estadisticas, $fecha) {
        return response("PDF de Mascotas - Total: {$estadisticas['total']} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/pdf')
               ->header('Content-Disposition', 'attachment; filename="reporte-mascotas.pdf"');
    }
    
    private function generarExcelMascotas($mascotas, $estadisticas, $fecha) {
        return response("Excel de Mascotas - Total: {$estadisticas['total']} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
               ->header('Content-Disposition', 'attachment; filename="reporte-mascotas.xlsx"');
    }
    
    private function generarWordMascotas($mascotas, $estadisticas, $fecha) {
        return response("Word de Mascotas - Total: {$estadisticas['total']} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
               ->header('Content-Disposition', 'attachment; filename="reporte-mascotas.docx"');
    }
    
    private function generarPdfMascotasEstado($mascotas, $estado, $total, $fecha) {
        return response("PDF de Mascotas {$estado} - Total: {$total} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/pdf')
               ->header('Content-Disposition', 'attachment; filename="reporte-mascotas-{$estado}.pdf"');
    }
    
    private function generarExcelMascotasEstado($mascotas, $estado, $total, $fecha) {
        return response("Excel de Mascotas {$estado} - Total: {$total} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
               ->header('Content-Disposition', 'attachment; filename="reporte-mascotas-{$estado}.xlsx"');
    }
    
    private function generarWordMascotasEstado($mascotas, $estado, $total, $fecha) {
        return response("Word de Mascotas {$estado} - Total: {$total} - Fecha: {$fecha}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
               ->header('Content-Disposition', 'attachment; filename="reporte-mascotas-{$estado}.docx"');
    }
    
    private function generarPdfEstadisticas($estadisticas) {
        return response("PDF de Estadísticas - Fecha: {$estadisticas['fecha_generacion']}")
               ->header('Content-Type', 'application/pdf')
               ->header('Content-Disposition', 'attachment; filename="reporte-estadisticas.pdf"');
    }
    
    private function generarExcelEstadisticas($estadisticas) {
        return response("Excel de Estadísticas - Fecha: {$estadisticas['fecha_generacion']}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
               ->header('Content-Disposition', 'attachment; filename="reporte-estadisticas.xlsx"');
    }
    
    private function generarWordEstadisticas($estadisticas) {
        return response("Word de Estadísticas - Fecha: {$estadisticas['fecha_generacion']}")
               ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
               ->header('Content-Disposition', 'attachment; filename="reporte-estadisticas.docx"');
    }
}