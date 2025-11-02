<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Donde redirigir después del login
     */
    protected function redirectTo()
    {
        $user = Auth::user();
        
        // Redirigir según el rol
        if ($user->hasRole('Administrador')) {
            return '/admin/dashboard';
        }
        
        // Usuario normal va a la página de inicio
        return '/';
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        // Redirigir según el rol
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('inicio');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}