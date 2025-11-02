<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Si es administrador, redirigir al dashboard de admin
        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        }
        
        // Usuario normal: redirigir a la página de inicio (welcome)
        return redirect()->route('inicio');
    }
}