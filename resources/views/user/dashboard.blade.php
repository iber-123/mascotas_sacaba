<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel - Mascotas Sacaba</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .floating-card {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="min-h-screen py-8">
    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Compacto -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 gradient-bg rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-paw text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Mi Panel</h1>
                    <p class="text-white/80 text-sm">Mascotas Sacaba</p>
                </div>
            </div>
            
            <!-- Menú Usuario -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="text-white/90 hover:text-white transition-colors">
                    <i class="fas fa-home text-lg"></i>
                </a>
                <a href="{{ route('buscar') }}" class="text-white/90 hover:text-white transition-colors">
                    <i class="fas fa-search text-lg"></i>
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-3 bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-xl hover:bg-white/30 transition-all">
                        <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center">
                            <span class="font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl py-2 z-50">
                        <a href="{{ route('user.dashboard') }}" class="menu-item">
                            <i class="fas fa-tachometer-alt text-purple-500"></i>
                            Mi Panel
                        </a>
                        <a href="{{ route('user.perfil.edit') }}" class="menu-item">
                            <i class="fas fa-user-edit text-blue-500"></i>
                            Mi Perfil
                        </a>
                        <div class="border-t my-1"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item text-red-600">
                            <i class="fas fa-sign-out-alt"></i>
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido del Dashboard -->
        <div class="dashboard-container rounded-3xl floating-card p-8">
            <!-- Bienvenida -->
            <div class="text-center mb-12">
                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <span class="text-white font-bold text-2xl">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">
                    ¡Hola, <span class="gradient-text">{{ Auth::user()->name }}</span>!
                </h1>
                <p class="text-gray-600 text-lg">¿Qué te gustaría hacer hoy?</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Columna Izquierda - Acciones Rápidas -->
                <div class="space-y-6">
                    <!-- Perfil Rápido -->
                    <div class="glass-card rounded-2xl p-6 floating-card">
                        <div class="text-center">
                            <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <h3 class="font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Auth::user()->email }}</p>
                            <a href="{{ route('user.perfil.edit') }}" class="inline-flex items-center gradient-bg text-white px-4 py-2 rounded-xl text-sm font-semibold hover:shadow-lg transition-all">
                                <i class="fas fa-edit mr-2"></i>
                                Editar Perfil
                            </a>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="glass-card rounded-2xl p-6 floating-card">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-chart-bar text-purple-500 mr-2"></i>
                            Mis Estadísticas
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-xl">
                                <span class="text-blue-700 font-medium">Mascotas</span>
                                <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold">5</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-xl">
                                <span class="text-green-700 font-medium">Reportes Activos</span>
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-bold">3</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-purple-50 rounded-xl">
                                <span class="text-purple-700 font-medium">Encontradas</span>
                                <span class="bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-bold">2</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Central - Acciones Principales -->
                <div class="space-y-6">
                    <!-- Acciones Principales -->
                    <div class="glass-card rounded-2xl p-6 floating-card">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-rocket text-orange-500 mr-2"></i>
                            Acciones Principales
                        </h3>
                        <div class="space-y-4">
                            <a href="{{ route('user.reportes.create') }}" class="action-card bg-red-50 border border-red-200 hover-scale">
                                <div class="action-icon bg-red-500">
                                    <i class="fas fa-search-location text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Mascota Perdida</h4>
                                    <p class="text-gray-600 text-sm">Reportar pérdida</p>
                                </div>
                            </a>

                            <a href="{{ route('user.reportes.create') }}" class="action-card bg-green-50 border border-green-200 hover-scale">
                                <div class="action-icon bg-green-500">
                                    <i class="fas fa-home text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Mascota Encontrada</h4>
                                    <p class="text-gray-600 text-sm">Reportar hallazgo</p>
                                </div>
                            </a>

                            <a href="{{ route('user.mascotas.create') }}" class="action-card bg-blue-50 border border-blue-200 hover-scale">
                                <div class="action-icon bg-blue-500">
                                    <i class="fas fa-paw text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Registrar Mascota</h4>
                                    <p class="text-gray-600 text-sm">Agregar nueva</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Acceso Rápido -->
                    <div class="glass-card rounded-2xl p-6 floating-card">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                            Acceso Rápido
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('buscar') }}" class="quick-link">
                                <i class="fas fa-search text-blue-500"></i>
                                <span>Buscar</span>
                            </a>
                            <a href="{{ route('user.mascotas.index') }}" class="quick-link">
                                <i class="fas fa-paw text-purple-500"></i>
                                <span>Mis Mascotas</span>
                            </a>
                            <a href="{{ route('user.reportes.index') }}" class="quick-link">
                                <i class="fas fa-file-alt text-green-500"></i>
                                <span>Mis Reportes</span>
                            </a>
                            <a href="{{ url('/') }}" class="quick-link">
                                <i class="fas fa-home text-gray-500"></i>
                                <span>Inicio</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha - Actividad -->
                <div class="space-y-6">
                    <!-- Reportes Recientes -->
                    <div class="glass-card rounded-2xl p-6 floating-card">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-800 flex items-center">
                                <i class="fas fa-clock text-purple-500 mr-2"></i>
                                Actividad Reciente
                            </h3>
                            <a href="{{ route('user.reportes.index') }}" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">
                                Ver todo
                            </a>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="activity-item">
                                <div class="activity-icon bg-yellow-500">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Max reportado como perdido</p>
                                    <p class="text-gray-600 text-xs">Hace 2 días • Zona Central</p>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon bg-green-500">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Luna encontrada</p>
                                    <p class="text-gray-600 text-xs">Hace 1 semana • Villa Busch</p>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon bg-blue-500">
                                    <i class="fas fa-paw text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Rocky registrado</p>
                                    <p class="text-gray-600 text-xs">Hace 2 semanas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notificaciones -->
                    <div class="glass-card rounded-2xl p-6 floating-card">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-bell text-red-500 mr-2"></i>
                            Notificaciones
                        </h3>
                        <div class="space-y-3">
                            <div class="notification bg-blue-50 border-l-4 border-blue-500">
                                <i class="fas fa-comment text-blue-500"></i>
                                <div>
                                    <p class="text-sm font-medium">Nuevo comentario</p>
                                    <p class="text-xs text-gray-600">En reporte de Max</p>
                                </div>
                            </div>
                            <div class="notification bg-green-50 border-l-4 border-green-500">
                                <i class="fas fa-thumbs-up text-green-500"></i>
                                <div>
                                    <p class="text-sm font-medium">Reporte útil</p>
                                    <p class="text-xs text-gray-600">Tu reporte ayudó</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Principal -->
            <div class="text-center mt-12">
                <a href="{{ route('user.reportes.create') }}" class="inline-flex items-center gradient-bg text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all hover-scale">
                    <i class="fas fa-plus-circle mr-3 text-xl"></i>
                    Crear Nuevo Reporte
                </a>
            </div>
        </div>
    </div>

    <style>
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .menu-item {
            @apply flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors text-sm;
        }
        .menu-item i {
            @apply w-5 mr-3 text-center;
        }
        .action-card {
            @apply flex items-center p-4 rounded-xl transition-all duration-300 cursor-pointer;
        }
        .action-icon {
            @apply w-12 h-12 rounded-xl flex items-center justify-center mr-4;
        }
        .quick-link {
            @apply flex flex-col items-center p-3 bg-gray-50 rounded-xl hover:bg-white hover:shadow-md transition-all text-center;
        }
        .quick-link i {
            @apply text-xl mb-2;
        }
        .quick-link span {
            @apply text-xs font-medium text-gray-700;
        }
        .activity-item {
            @apply flex items-center p-3 bg-gray-50 rounded-xl;
        }
        .activity-icon {
            @apply w-10 h-10 rounded-xl flex items-center justify-center mr-3;
        }
        .notification {
            @apply flex items-start p-3 rounded-r-xl;
        }
        .notification i {
            @apply mt-1 mr-3;
        }
        #logout-form {
            display: none;
        }
    </style>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</body>
</html>