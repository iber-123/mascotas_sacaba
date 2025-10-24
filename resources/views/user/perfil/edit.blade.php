<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Mascotas Sacaba</title>
    
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Tailwind CSS para el header/footer -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        /* Estilos para el header personalizado */
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background-color: rgba(34, 197, 94, 0.1);
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #22c55e;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 80%;
        }
        .auth-link {
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .auth-link:hover {
            background-color: rgba(34, 197, 94, 0.1);
        }
        .auth-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #22c55e;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .auth-link:hover::after {
            width: 80%;
        }
        
        /* Estilos para el contenido AdminLTE */
        .profile-user-img {
            border: 3px solid #adb5bd;
            margin: 0 auto;
            padding: 3px;
            width: 100px;
            height: 100px;
        }
        .card-primary.card-outline {
            border-top: 3px solid #007bff;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        }
        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
        }
        .list-group-item {
            border-left: 0;
            border-right: 0;
        }
        .list-group-item:first-child {
            border-top: 0;
        }
        .list-group-item:last-child {
            border-bottom: 0;
        }
        
        /* Asegurar que el contenido principal tenga suficiente espacio */
        .main-content {
            min-height: calc(100vh - 140px);
            padding: 2rem 0;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Header personalizado -->
    <header class="py-4 px-6 sticky top-0 bg-white/95 backdrop-blur-sm z-10 shadow-sm" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Mascotas Sacaba</span>
                </div>
            </div>
            <nav class="hidden md:flex space-x-2">
                <a href="{{ url('/') }}" class="nav-link text-gray-600 hover:text-green-600 font-medium">Inicio</a>
                <a href="{{ route('buscar') }}" class="nav-link text-gray-600 hover:text-green-600 font-medium">Buscar</a>
                <a href="{{ route('estadisticas') }}" class="nav-link text-gray-600 hover:text-green-600 font-medium">Estadísticas</a>
            </nav>
            <div class="flex items-center space-x-2">
                @auth
                    <a href="{{ route('user.dashboard') }}" class="auth-link font-semibold text-gray-600 hover:text-green-600">Dashboard</a>
                    <a href="{{ route('user.perfil.edit') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Mi Perfil</a>
                @else
                    <a href="{{ route('login') }}" class="auth-link font-semibold text-gray-600 hover:text-green-600">Iniciar sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Registrarse</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="text-primary"><i class="fas fa-user-circle mr-2"></i>Mi Perfil</h1>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Columna izquierda: Información del perfil -->
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <img class="profile-user-img img-fluid img-circle" 
                                                 src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=128&background=22c55e&color=ffffff' }}" 
                                                 alt="Foto de perfil de {{ $user->name }}"
                                                 style="width: 128px; height: 128px; object-fit: cover; border: 4px solid #e3f2fd;">
                                            <button class="btn btn-light btn-sm position-absolute rounded-circle" 
                                                    style="bottom: 10px; right: 10px; width: 32px; height: 32px;"
                                                    data-toggle="tooltip" title="Cambiar foto">
                                                <i class="fas fa-camera text-muted"></i>
                                            </button>
                                        </div>
                                        <h3 class="profile-username mt-3">{{ $user->name }}</h3>
                                        <p class="text-muted mb-1">{{ $user->email }}</p>
                                        <span class="badge badge-success">Usuario verificado</span>
                                    </div>

                                    <ul class="list-group list-group-unbordered mt-3">
                                        <li class="list-group-item">
                                            <b>Miembro desde</b>
                                            <span class="float-right text-muted">{{ $user->created_at->format('d/m/Y') }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Última actualización</b>
                                            <span class="float-right text-muted">{{ $user->updated_at->format('d/m/Y') }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Estado</b>
                                            <span class="float-right">
                                                <span class="badge badge-success">Activo</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Tarjeta de estadísticas rápidas -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>Mi Actividad</h3>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Mascotas reportadas
                                                <span class="float-right badge bg-primary">5</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Mascotas encontradas
                                                <span class="float-right badge bg-success">3</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Comentarios
                                                <span class="float-right badge bg-warning">12</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Columna derecha: Información detallada y formularios -->
                        <div class="col-md-8">
                            <!-- Información personal -->
                            <div class="card">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i>Información Personal</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-toggle="modal" data-target="#editProfileModal">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><i class="fas fa-user mr-1 text-primary"></i> Nombre completo</strong>
                                            <p class="text-muted">{{ $user->name }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><i class="fas fa-envelope mr-1 text-primary"></i> Correo electrónico</strong>
                                            <p class="text-muted">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><i class="fas fa-phone mr-1 text-primary"></i> Teléfono</strong>
                                            <p class="text-muted">{{ $user->phone ?? 'No registrado' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><i class="fas fa-map-marker-alt mr-1 text-primary"></i> Ubicación</strong>
                                            <p class="text-muted">{{ $user->location ?? 'Sacaba, Bolivia' }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <strong><i class="fas fa-info-circle mr-1 text-primary"></i> Acerca de mí</strong>
                                            <p class="text-muted">
                                                {{ $user->bio ?? 'Amante de los animales y miembro activo de la comunidad Mascotas Sacaba. Comprometido con el bienestar animal y la reunificación de mascotas con sus familias.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cambio de contraseña -->
                            <div class="card mt-4">
                                <div class="card-header bg-gradient-warning">
                                    <h3 class="card-title text-white"><i class="fas fa-lock mr-1"></i>Seguridad</h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-3">Actualiza tu contraseña para mantener tu cuenta segura.</p>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#changePasswordModal">
                                        <i class="fas fa-key mr-1"></i> Cambiar Contraseña
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer personalizado -->
    <footer class="bg-gray-900 text-white py-12" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Información principal -->
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-white mb-4">Mascotas Perdidas Sacaba</h2>
                <p class="text-gray-300 max-w-3xl mx-auto text-lg">
                    Una plataforma comunitaria dedicada a reunir mascotas perdidas con sus familias y facilitar la adopción de animales que necesitan un hogar en Sacaba, Cochabamba.
                </p>
            </div>
            
            <!-- Fila de Ubicación, Emergencias y Contacto -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <!-- Ubicación -->
                <div class="text-center">
                    <div class="bg-green-500 p-3 rounded-full w-14 h-14 mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white text-lg mb-2">Ubicación</h3>
                    <p class="text-gray-300">OTB Korihuma2, Sacaba</p>
                </div>
                
                <!-- Emergencias -->
                <div class="text-center">
                    <div class="bg-red-500 p-3 rounded-full w-14 h-14 mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white text-lg mb-2">Emergencias</h3>
                    <p class="text-gray-300">911 - Emergencias</p>
                </div>
                
                <!-- Contacto -->
                <div class="text-center">
                    <div class="bg-blue-500 p-3 rounded-full w-14 h-14 mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white text-lg mb-2">Contacto</h3>
                    <p class="text-gray-300">info@mascotassacaba.com</p>
                </div>
            </div>
            
            <!-- Información adicional y copyright -->
            <div class="text-center pt-8 border-t border-gray-700">
                <p class="text-gray-300 mb-6 max-w-2xl mx-auto">
                    Una iniciativa para promover la tenencia responsable de mascotas y fortalecer los lazos entre la comunidad y los animales.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <p class="text-gray-400 text-sm">
                        © 2024 Mascotas Perdidas Sacaba. Todos los derechos reservados.
                    </p>
                    <p class="text-gray-400 text-sm flex items-center">
                        Desarrollado con 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 115.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                        para nuestra comunidad.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal para editar perfil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editProfileModalLabel"><i class="fas fa-edit mr-1"></i>Editar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nombre completo</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="tel" class="form-control" id="phone" value="{{ $user->phone ?? '' }}" placeholder="Ingresa tu número de teléfono">
                        </div>
                        <div class="form-group">
                            <label for="location">Ubicación</label>
                            <input type="text" class="form-control" id="location" value="{{ $user->location ?? '' }}" placeholder="Ej: Sacaba, Bolivia">
                        </div>
                        <div class="form-group">
                            <label for="bio">Acerca de mí</label>
                            <textarea class="form-control" id="bio" rows="3" placeholder="Cuéntanos algo sobre ti">{{ $user->bio ?? '' }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="changePasswordModalLabel"><i class="fas fa-key mr-1"></i>Cambiar Contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="currentPassword">Contraseña actual</label>
                            <input type="password" class="form-control" id="currentPassword" placeholder="Ingresa tu contraseña actual">
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Nueva contraseña</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Ingresa tu nueva contraseña">
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirmar nueva contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Repite tu nueva contraseña">
                        </div>
                        <div class="alert alert-info">
                            <small><i class="fas fa-info-circle mr-1"></i> La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning">Actualizar Contraseña</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Mostrar notificación de éxito al guardar cambios
            $('.btn-primary').on('click', function() {
                if ($(this).text().includes('Guardar')) {
                    $('#editProfileModal').modal('hide');
                    toastr.success('Perfil actualizado correctamente');
                }
            });
            
            $('.btn-warning').on('click', function() {
                if ($(this).text().includes('Actualizar Contraseña')) {
                    $('#changePasswordModal').modal('hide');
                    toastr.success('Contraseña actualizada correctamente');
                }
            });
        });
    </script>
</body>
</html>