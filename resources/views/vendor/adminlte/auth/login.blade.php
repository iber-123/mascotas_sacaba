<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Mascotas Sacaba</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f0f9f0 0%, #e6f4e6 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .login-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
        }
        
        .login-header {
            background: white;
            color: #1f2937;
            padding: 2rem 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .login-body {
            padding: 1.5rem 2rem 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        
        .login-button {
            width: 100%;
            background: #22c55e;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.875rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }
        
        .login-button:hover {
            background: #16a34a;
        }
        
        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 1.5rem 0;
        }
        
        .register-link {
            text-align: center;
            margin: 1.5rem 0;
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .register-link a {
            color: #22c55e;
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .benefits-text {
            background: #f9fafb;
            padding: 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            line-height: 1.5;
            color: #6b7280;
            margin-top: 1.5rem;
        }
        
        .google-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            background: white;
            color: #374151;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }
        
        .google-button:hover {
            background: #f9fafb;
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        
        .forgot-password a {
            color: #22c55e;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        
        .logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            border: 2px solid white;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #22c55e;
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .checkbox-container input[type="checkbox"] {
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
        }
        
        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #6b7280;
            font-size: 1rem;
        }
        
        /* Estilos mejorados para el header */
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
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
        
        .login-nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .login-nav-link:hover {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }
        
        .login-nav-link::after {
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
        
        .login-nav-link:hover::after {
            width: 80%;
        }
        
        .login-nav-link.active {
            background-color: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            font-weight: 600;
        }
        
        .login-nav-link.active::after {
            width: 80%;
        }
        
        .register-nav-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .register-nav-btn:hover {
            background-color: #16a34a;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        /* Mejoras adicionales para el header */
        .header-container {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .header-content {
            max-width: 7xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Header de navegación mejorado -->
    <header class="header-container">
        <div class="header-content">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <span class="text-xl font-bold text-gray-800">Mascotas Sacaba</span>
            </div>
            <nav class="hidden md:flex space-x-2">
                <!-- CORREGIDO: Enlaces funcionales -->
                <a href="{{ url('/') }}" class="nav-link text-gray-600 font-medium">Inicio</a>
                <a href="{{ url('/buscar') }}" class="nav-link text-gray-600 font-medium">Buscar</a>
                <a href="{{ url('/estadisticas') }}" class="nav-link text-gray-600 font-medium">Estadísticas</a>
            </nav>
            <div class="flex items-center space-x-2">
                <a href="{{ route('login') }}" class="login-nav-link font-semibold text-gray-600 active">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="register-nav-btn bg-green-500 text-white px-4 py-2 rounded-lg font-medium">Registrarse</a>
            </div>
        </div>
    </header>

    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-paw text-white"></i>
                    </div>
                    <div class="logo-text">Mascotas Sacaba</div>
                </div>
                <h1 class="page-title">Iniciar Sesión</h1>
                <p class="page-subtitle">Accede a tu cuenta para reportar y gestionar mascotas</p>
            </div>
            
            <div class="login-body">
                <form action="{{ url('login') }}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-input @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}" placeholder="tu@email.com" autofocus required>
                        
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-input @error('password') border-red-500 @enderror"
                            placeholder="Tu contraseña" required>
                        
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Recordar sesión</label>
                    </div>
                    
                    <button type="submit" class="login-button">
                        Iniciar Sesión
                    </button>
                </form>
                
                <div class="register-link">
                    ¿No tienes una cuenta? <a href="{{ url('register') }}">Regístrate aquí</a>
                </div>
                
                <div class="benefits-text">
                    Al iniciar sesión, podrás reportar mascotas perdidas, gestionar tus reportes y contactar con otros usuarios.
                </div>
                
                <div class="divider"></div>
                
                <a href="{{ url('auth/google') }}" class="google-button">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Iniciar sesión con Google
                </a>
                
                <div class="forgot-password">
                    <a href="{{ url('password/reset') }}">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer con Elementos en Fila -->
    <footer class="bg-gray-900 text-white py-12">
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
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                        para nuestra comunidad.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Efectos de hover mejorados para el header
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link, .login-nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(34, 197, 94, 0.1)';
                    this.style.color = '#22c55e';
                });
                
                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '';
                        this.style.color = '';
                    }
                });
            });
        });
    </script>
</body>
</html>