<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $mascotas = $user->mascotas()->count();

        // Agregamos los datos adicionales que necesita la vista
        $perdidas = 0; // Temporal - reemplazar con lógica real después
        $notificaciones = 0; // Temporal - reemplazar con lógica real después  
        $resueltos = 0; // Temporal - reemplazar con lógica real después
        $actividades = []; // Temporal - array vacío por ahora

        return view('user.dashboard', compact(
            'user', 
            'mascotas',
            'perdidas',
            'notificaciones', 
            'resueltos',
            'actividades'
        ));
    }
     public function reportesIndex()
    {
        return view('user.reportes.index'); // crea esta vista
    }

    public function reportesCreate()
    {
        return view('user.reportes.create'); // crea esta vista
    }

    // Mantén este método si ya existe, si no, agrégalo:
   public function perfil()
{
    $user = Auth::user();
    return view('user.perfil.edit', compact('user'));
}

}