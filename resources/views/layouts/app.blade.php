<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plataforma comunitaria para encontrar mascotas perdidas en Sacaba, Cochabamba">
    <title>@yield('title', 'Mascotas Perdidas Sacaba')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --secondary: #3b82f6;
            --accent: #059669;
            --danger: #ef4444;
            --purple: #8b5cf6;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        
        .hero-bg {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 50%, #a7f3d0 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2310b981' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(16, 185, 129, 0.35);
        }
        
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #374151;
        }
        
        .nav-link.inicio:hover {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--primary);
        }
        
        .nav-link.perdidas:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        
        .nav-link.encontradas:hover {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--secondary);
        }
        
        .nav-link.adopcion:hover {
            background-color: rgba(139, 92, 246, 0.1);
            color: var(--purple);
        }
        
        .nav-link.login:hover {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--accent);
        }
        
        .nav-link.register:hover {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--primary);
        }
        
        .nav-link.inicio.active {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--primary);
            font-weight: 600;
        }
        
        .nav-link.perdidas.active {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            font-weight: 600;
        }
        
        .nav-link.encontradas.active {
            background-color: rgba(59, 130, 246, 0.15);
            color: var(--secondary);
            font-weight: 600;
        }
        
        .nav-link.adopcion.active {
            background-color: rgba(139, 92, 246, 0.15);
            color: var(--purple);
            font-weight: 600;
        }
        
        .nav-link.login.active {
            background-color: rgba(245, 158, 11, 0.15);
            color: var(--accent);
            font-weight: 600;
        }
        
        .nav-link.register.active {
            background-color: rgba(16, 185, 129, 0.2);
            color: var(--primary);
            font-weight: 600;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link.inicio::after {
            background-color: var(--primary);
        }
        
        .nav-link.perdidas::after {
            background-color: var(--danger);
        }
        
        .nav-link.encontradas::after {
            background-color: var(--secondary);
        }
        
        .nav-link.adopcion::after {
            background-color: var(--purple);
        }
        
        .nav-link.login::after {
            background-color: var(--accent);
        }
        
        .nav-link.register::after {
            background-color: var(--primary);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        .pet-image {
            height: 160px;
            object-fit: cover;
            width: 100%;
            border-radius: 12px;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -10px); }
            100% { transform: translate(0, 0px); }
        }
        
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), transparent);
            border-radius: 3px;
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        @media (max-width: 768px) {
            .mobile-menu {
                display: block;
            }
            .desktop-menu {
                display: none;
            }
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Estilos para la sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .sidebar-content {
            position: fixed;
            top: 0;
            right: -320px;
            width: 320px;
            height: 100%;
            background: white;
            z-index: 9999;
            transition: right 0.3s ease;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar-content.active {
            right: 0;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="py-4 px-4 sm:px-6 sticky top-0 bg-white/95 backdrop-blur-sm z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('inicio') }}" class="flex items-center hover:opacity-80 transition-opacity">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-3 shadow-md">
                        <i class="fas fa-paw text-white text-sm sm:text-lg"></i>
                    </div>
                    <div class="hidden sm:block">
                        <span class="text-lg sm:text-xl font-bold text-gray-800">Mascotas Sacaba</span>
                        <p class="text-xs text-gray-500 -mt-1">Encuentra a tu compañero</p>
                    </div>
                </a>
            </div>
            
            <nav class="hidden md:flex space-x-1">
                <a href="{{ route('inicio') }}" class="nav-link inicio {{ request()->routeIs('inicio') ? 'active' : '' }} flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    Inicio
                </a>
                <a href="{{ route('mascotas.perdidas.index') }}" class="nav-link perdidas {{ request()->routeIs('mascotas.perdidas.index') ? 'active' : '' }} flex items-center">
                    <i class="fas fa-search-location mr-2"></i>
                    Perdidas
                </a>
                <a href="{{ route('mascotas.encontradas.public') }}" class="nav-link encontradas {{ request()->routeIs('mascotas.encontradas.public') ? 'active' : '' }} flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    Encontradas
                </a>
                <a href="{{ route('mascotas.adopcion.public') }}" class="nav-link adopcion {{ request()->routeIs('mascotas.adopcion.public') ? 'active' : '' }} flex items-center">
                    <i class="fas fa-heart mr-2"></i>
                    En Adopción
                </a>
            </nav>

            <div class="md:hidden mobile-menu">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-green-600 transition-colors p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <div class="hidden md:flex items-center space-x-2">
                @auth
                    <!-- Botón Mi Cuenta -->
                    <button onclick="openSidebar()" class="nav-link login flex items-center space-x-2">
                        <i class="fas fa-user-circle"></i>
                        <span>Mi Cuenta</span>
                    </button>

                    <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl font-semibold transition-all text-sm sm:text-base">
                        <i class="fas fa-plus-circle mr-2"></i> Reportar
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-link login {{ request()->routeIs('login') ? 'active' : '' }} flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link register {{ request()->routeIs('register') ? 'active' : '' }} bg-green-500 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Menú Móvil -->
        <div id="mobile-menu" class="md:hidden hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-gray-200 py-4">
            <div class="flex flex-col space-y-3 px-6">
                <a href="{{ route('inicio') }}" class="nav-link inicio {{ request()->routeIs('inicio') ? 'active' : '' }} py-2 flex items-center">
                    <i class="fas fa-home mr-3"></i> Inicio
                </a>
                <a href="{{ route('mascotas.perdidas.index') }}" class="nav-link perdidas {{ request()->routeIs('mascotas.perdidas.index') ? 'active' : '' }} py-2 flex items-center">
                    <i class="fas fa-search-location mr-3"></i> Perdidas
                </a>
                <a href="{{ route('mascotas.encontradas.public') }}" class="nav-link encontradas {{ request()->routeIs('mascotas.encontradas.public') ? 'active' : '' }} py-2 flex items-center">
                    <i class="fas fa-home mr-3"></i> Encontradas
                </a>
                <a href="{{ route('mascotas.adopcion.public') }}" class="nav-link adopcion {{ request()->routeIs('mascotas.adopcion.public') ? 'active' : '' }} py-2 flex items-center">
                    <i class="fas fa-heart mr-3"></i> En Adopción
                </a>
                
                <div class="border-t border-gray-200 pt-4 mt-2">
                    @auth
                        <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-4 py-2.5 rounded-xl font-semibold transition-all text-center block">
                            <i class="fas fa-plus-circle mr-2"></i> Reportar Mascota
                        </a>
                        
                        <a href="{{ route('afiches.create') }}" class="nav-link login py-2 flex items-center mt-2">
                            <i class="fas fa-file-image mr-3"></i> Crear Afiche
                        </a>
                        
                        <a href="{{ route('user.perfil.edit') }}" class="nav-link login py-2 flex items-center">
                            <i class="fas fa-user-edit mr-3"></i> Editar Perfil
                        </a>
                        
                        <a href="{{ route('user.mascotas.index') }}" class="nav-link login py-2 flex items-center">
                            <i class="fas fa-paw mr-3"></i> Mis Mascotas
                        </a>
                        
                        <a href="{{ route('contactar.index') }}" class="nav-link login py-2 flex items-center">
                            <i class="fas fa-envelope mr-3"></i> Mis Mensajes
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="w-full text-left nav-link login py-2 flex items-center text-red-600">
                                <i class="fas fa-sign-out-alt mr-3"></i> Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary px-4 py-2.5 rounded-xl font-semibold transition-all text-center block">
                            <i class="fas fa-plus-circle mr-2"></i> Reportar Mascota
                        </a>
                        <div class="flex space-x-2 mt-2">
                            <a href="{{ route('login') }}" class="nav-link login {{ request()->routeIs('login') ? 'active' : '' }} py-2 flex-1 text-center">
                                Iniciar sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link register {{ request()->routeIs('register') ? 'active' : '' }} py-2 flex-1 text-center border border-gray-300 rounded-lg">
                                    Registrarse
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar para Mi Cuenta -->
    @auth
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
    <div class="sidebar-content" id="sidebarContent">
        <!-- Header Sidebar -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-blue-50">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">Mi Cuenta</h2>
                <button onclick="closeSidebar()" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <p class="text-gray-600 text-sm mt-2">Hola, {{ Auth::user()->name }}</p>
        </div>

        <!-- Navegación -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('afiches.create') }}" onclick="closeSidebar()" class="flex items-center p-3 rounded-lg hover:bg-green-50 text-gray-700 hover:text-green-700 transition-colors border border-transparent hover:border-green-200">
                <i class="fas fa-file-image w-6 text-green-600"></i>
                <span class="ml-3 font-medium">Crear Afiche</span>
            </a>
            
            <a href="{{ route('user.perfil.edit') }}" onclick="closeSidebar()" class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors border border-transparent hover:border-blue-200">
                <i class="fas fa-user-edit w-6 text-blue-600"></i>
                <span class="ml-3 font-medium">Editar Perfil</span>
            </a>
            
            <a href="{{ route('user.mascotas.index') }}" onclick="closeSidebar()" class="flex items-center p-3 rounded-lg hover:bg-purple-50 text-gray-700 hover:text-purple-700 transition-colors border border-transparent hover:border-purple-200">
                <i class="fas fa-paw w-6 text-purple-600"></i>
                <span class="ml-3 font-medium">Mis Mascotas</span>
            </a>
            
            <a href="{{ route('contactar.index') }}" onclick="closeSidebar()" class="flex items-center p-3 rounded-lg hover:bg-yellow-50 text-gray-700 hover:text-yellow-700 transition-colors border border-transparent hover:border-yellow-200">
                <i class="fas fa-envelope w-6 text-yellow-600"></i>
                <span class="ml-3 font-medium">Mis Mensajes</span>
            </a>

            <!-- Separador -->
            <div class="border-t border-gray-200 my-3"></div>

            <!-- Cerrar Sesión -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" onclick="closeSidebar()" class="w-full flex items-center p-3 rounded-lg hover:bg-red-50 text-red-600 hover:text-red-700 transition-colors border border-transparent hover:border-red-200">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="ml-3 font-medium">Cerrar Sesión</span>
                </button>
            </form>
        </nav>
    </div>
    @endauth

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white pt-12 pb-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-paw text-white"></i>
                        </div>
                        <span class="text-xl font-bold">Mascotas Sacaba</span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed max-w-md">
                        Plataforma comunitaria dedicada a reunir mascotas perdidas con sus familias en Sacaba, Cochabamba. Juntos podemos hacer la diferencia.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Categorías</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('inicio') }}" class="text-gray-400 hover:text-green-400 transition-colors text-sm">Inicio</a></li>
                        <li><a href="{{ route('mascotas.perdidas.index') }}" class="text-gray-400 hover:text-green-400 transition-colors text-sm">Mascotas Perdidas</a></li>
                        <li><a href="{{ route('mascotas.encontradas.public') }}" class="text-gray-400 hover:text-green-400 transition-colors text-sm">Mascotas Encontradas</a></li>
                        <li><a href="{{ route('mascotas.adopcion.public') }}" class="text-gray-400 hover:text-green-400 transition-colors text-sm">En Adopción</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Contacto</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-400 text-sm">
                            <i class="fas fa-map-marker-alt mr-3 text-green-500 text-xs"></i>
                            OTB Korihuma2, Sacaba
                        </li>
                        <li class="flex items-center text-gray-400 text-sm">
                            <i class="fas fa-phone mr-3 text-green-500 text-xs"></i>
                            +591 123 456 78
                        </li>
                        <li class="flex items-center text-gray-400 text-sm">
                            <i class="fas fa-envelope mr-3 text-green-500 text-xs"></i>
                            info@mascotassacaba.com
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-6 border-t border-gray-800 text-center">
                <p class="text-gray-400 text-xs sm:text-sm">
                    © 2024 Mascotas Perdidas Sacaba. Todos los derechos reservados.
                </p>
                <p class="text-gray-500 text-xs mt-1">
                    Desarrollado con <i class="fas fa-heart text-red-500 mx-1"></i> para nuestra comunidad
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Funciones para la sidebar
        function openSidebar() {
            document.getElementById('sidebarOverlay').classList.add('active');
            document.getElementById('sidebarContent').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            document.getElementById('sidebarOverlay').classList.remove('active');
            document.getElementById('sidebarContent').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Cerrar sidebar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });

        // Menú móvil
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    const icon = mobileMenuButton.querySelector('i');
                    if (mobileMenu.classList.contains('hidden')) {
                        icon.className = 'fas fa-bars text-xl';
                    } else {
                        icon.className = 'fas fa-times text-xl';
                    }
                });

                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.querySelector('i').className = 'fas fa-bars text-xl';
                    });
                });

                document.addEventListener('click', function(event) {
                    if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.querySelector('i').className = 'fas fa-bars text-xl';
                    }
                });
            }

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.feature-card, .stat-card, .fade-in-up').forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(element);
            });

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    const submitButton = this.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitButton) {
                        submitButton.classList.add('loading');
                        submitButton.disabled = true;
                    }
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>