<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\AficheController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReporteController as AdminReporteController;

// ===================== PÁGINAS PÚBLICAS =====================
Route::get('/', [WelcomeController::class, 'index'])->name('inicio');
Route::get('/buscar', [WelcomeController::class, 'buscar'])->name('buscar');

// RUTAS PÚBLICAS PARA MASCOTAS POR ESTADO
Route::get('/mascotas-perdidas', [MascotaController::class, 'perdidasPublic'])->name('mascotas.perdidas.index');
Route::get('/mascotas-encontradas', [MascotaController::class, 'encontradasPublic'])->name('mascotas.encontradas.public');
Route::get('/mascotas-adopcion', [MascotaController::class, 'adopcionPublic'])->name('mascotas.adopcion.public');

// NUEVAS RUTAS PÚBLICAS PARA VER DETALLES DE MASCOTAS
Route::get('/mascotas-perdidas/{mascota}', [MascotaController::class, 'showPublic'])->name('mascotas.perdidas.show');
Route::get('/mascotas-encontradas/{mascota}', [MascotaController::class, 'showEncontradaPublic'])->name('mascotas.encontradas.show');
Route::get('/mascotas-adopcion/{mascota}', [MascotaController::class, 'showAdopcionPublic'])->name('mascotas.adopcion.show');

// Rutas de autenticación estándar
Auth::routes(['verify' => true]);

// ===================== Google Auth =====================
Route::middleware(['web'])->group(function () {
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
});

// ===================== RUTAS PROTEGIDAS PARA USUARIOS AUTENTICADOS =====================
Route::middleware(['auth'])->group(function () {
    // ===================== RUTAS ESPECÍFICAS DE USUARIO =====================
    Route::prefix('user')->name('user.')->group(function () {
        // DASHBOARD PRINCIPAL DEL USUARIO
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        
        // Perfil de usuario
        Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil.edit');
        Route::put('/perfil', [UserController::class, 'updatePerfil'])->name('perfil.update');
        
        // Mascotas del usuario - RUTA GENERAL
        Route::resource('mascotas', MascotaController::class);

        // Rutas extras de mascotas por estado
        Route::get('/mascotas-perdidas', [MascotaController::class, 'perdidas'])->name('mascotas.perdidas');
        Route::get('/mascotas-encontradas', [MascotaController::class, 'encontradas'])->name('mascotas.encontradas');
        Route::get('/mascotas-adopcion', [MascotaController::class, 'adopcion'])->name('mascotas.adopcion');

        // RUTAS ESPECÍFICAS PARA CREAR MASCOTAS DENTRO DEL GRUPO USER
        Route::get('/mascotas/crear/perdida', [MascotaController::class, 'createPerdida'])->name('mascotas.crear.perdida');
        Route::get('/mascotas/crear/encontrada', [MascotaController::class, 'createEncontrada'])->name('mascotas.crear.encontrada');
        Route::get('/mascotas/crear/adopcion', [MascotaController::class, 'createAdopcion'])->name('mascotas.crear.adopcion');
    });

    // Rutas para acciones en mascotas públicas
    Route::get('/mascotas/{mascota}/contactar', [MascotaController::class, 'contactar'])->name('mascotas.contactar');
    Route::get('/mascotas/{mascota}/reportar', [MascotaController::class, 'reportar'])->name('mascotas.reportar');
    
    // SISTEMA SIMPLE DE CONTACTO
    Route::get('/contactar/{mascota}', [ContactoController::class, 'create'])->name('contactar.create');
    Route::post('/contactar', [ContactoController::class, 'store'])->name('contactar.store');
    Route::get('/mis-mensajes', [ContactoController::class, 'index'])->name('contactar.index');
    Route::post('/mensajes/{contacto}/leido', [ContactoController::class, 'marcarLeido'])->name('contactar.leido');
});

// RUTAS PARA AFICHES
Route::middleware(['auth'])->prefix('afiches')->name('afiches.')->group(function () { 
    Route::get('/crear', [AficheController::class, 'create'])->name('create');
    Route::post('/crear', [AficheController::class, 'store'])->name('store');
    Route::get('/mis-afiches', [AficheController::class, 'index'])->name('index');
    Route::get('/{afiche}/descargar-pdf', [AficheController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/{afiche}/descargar-imagen', [AficheController::class, 'downloadImage'])->name('download.image');
});

// ===================== RUTA DE REDIRECCIÓN PARA /home =====================
Route::get('/home', function () {
    return redirect()->route('user.dashboard');
});

// ===================== RUTAS ADMIN =====================
Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', AdminUserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    
    // RUTAS DE REPORTES PARA ADMIN
    Route::resource('reportes', AdminReporteController::class);
    Route::post('/reportes/vista-previa', [AdminReporteController::class, 'vistaPrevia'])->name('reportes.vista-previa');
    
    // RUTA CORREGIDA PARA EXPORTAR REPORTES
    Route::get('reportes/exportar/{tipo}/{formato}', [AdminReporteController::class, 'exportar'])
         ->name('reportes.exportar');
    
    // Ruta para cargar mascotas por usuario (AJAX)
    Route::get('/get-mascotas/{user}', [AdminReporteController::class, 'getMascotasByUser'])
         ->name('get.mascotas.by.user');

    // ===================== RUTAS CORREGIDAS PARA GESTIÓN DE MASCOTAS =====================
    Route::get('/mascotas', [App\Http\Controllers\Admin\MascotaController::class, 'index'])->name('mascotas.index');
    Route::get('/mascotas/crear', [App\Http\Controllers\Admin\MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [App\Http\Controllers\Admin\MascotaController::class, 'store'])->name('mascotas.store');
    Route::get('/mascotas/{mascota}', [App\Http\Controllers\Admin\MascotaController::class, 'show'])->name('mascotas.show');
    Route::get('/mascotas/{mascota}/editar', [App\Http\Controllers\Admin\MascotaController::class, 'edit'])->name('mascotas.edit');
    Route::put('/mascotas/{mascota}', [App\Http\Controllers\Admin\MascotaController::class, 'update'])->name('mascotas.update');
    Route::delete('/mascotas/{mascota}', [App\Http\Controllers\Admin\MascotaController::class, 'destroy'])->name('mascotas.destroy');
});

// ===================== RUTA DE FALLBACK =====================
Route::fallback(function () {
    return redirect()->route('inicio');
});