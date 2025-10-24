<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

// ===================== PÁGINAS PÚBLICAS =====================
Route::get('/', [WelcomeController::class, 'index'])->name('inicio');
Route::get('/estadisticas', [WelcomeController::class, 'estadisticas'])->name('estadisticas');

// RUTA DE BÚSQUEDA PÚBLICA
Route::get('/buscar', [WelcomeController::class, 'buscar'])->name('buscar');

// RUTAS PÚBLICAS PARA MASCOTAS POR ESTADO
Route::get('/mascotas-perdidas', [MascotaController::class, 'perdidasPublic'])->name('mascotas.perdidas.index');
Route::get('/mascotas-encontradas', [MascotaController::class, 'encontradasPublic'])->name('mascotas.encontradas.public');
Route::get('/mascotas-adopcion', [MascotaController::class, 'adopcionPublic'])->name('mascotas.adopcion.public');

// Rutas de autenticación estándar
Auth::routes(['verify' => true]);

// ===================== RUTAS DE REDIRECCIÓN MEJORADAS =====================
Route::middleware(['auth'])->group(function () {
    // Ruta para verificar y redirigir según el rol - CORREGIDA
    Route::get('/check-role', function () {
        $user = Auth::user();
        
        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        } 
        elseif ($user->hasRole('Usuario')) {
            return redirect()->route('user.dashboard');
        }
        else {
            // Si no tiene rol asignado, asignar rol de Usuario por defecto
            $user->assignRole('Usuario');
            return redirect()->route('user.dashboard');
        }
    })->name('check.role');

    // Redirigir /home a la verificación de rol
    Route::get('/home', function () {
        return redirect()->route('check.role');
    });
});

// ===================== Google Auth =====================
Route::middleware(['web'])->group(function () {
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
});

// ===================== RUTAS ADMIN =====================
Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', AdminUserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

// ===================== RUTAS USUARIO =====================
Route::middleware(['auth', 'role:Usuario'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // ===================== RUTAS EXTRAS DE MASCOTAS =====================
    Route::prefix('mascotas')->name('mascotas.')->group(function () {
        Route::get('/perdidas', [MascotaController::class, 'perdidas'])->name('perdidas');
        Route::get('/encontradas', [MascotaController::class, 'encontradas'])->name('encontradas');
        Route::get('/adopcion', [MascotaController::class, 'adopcion'])->name('adopcion');
    });

    // ===================== RUTAS RESOURCE DE MASCOTAS =====================
    Route::resource('mascotas', MascotaController::class);

    // ===================== RUTAS DE PERFIL =====================
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil.edit');
    Route::put('/perfil', [UserController::class, 'updatePerfil'])->name('perfil.update');

    // ===================== RUTAS RESOURCE DE REPORTES =====================
    Route::resource('reportes', ReporteController::class);
});

// ===================== RUTA DE FALLBACK POR SI ACASO =====================
Route::get('/user', function () {
    return redirect()->route('user.dashboard');
});