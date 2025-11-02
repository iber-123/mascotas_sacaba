@extends('layouts.app')

@section('title', 'Crear Cuenta - Mascotas Sacaba')

@section('content')
<div class="register-container">
    <div class="register-box">
        <div class="register-header">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <div class="logo-text">Mascotas Sacaba</div>
            </div>
            <h1 class="page-title">Crear Cuenta</h1>
            <p class="page-subtitle">Únete a nuestra comunidad para ayudar a reunir mascotas con sus familias</p>
        </div>
        
        <div class="register-body">
            <form action="{{ url('register') }}" method="post">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" name="name" class="form-input @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" placeholder="Tu nombre completo" autofocus required>
                    
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" placeholder="tu@email.com" required>
                    
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-input @error('password') border-red-500 @enderror"
                        placeholder="Crea una contraseña segura" required>
                    
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-input"
                        placeholder="Repite tu contraseña" required>
                </div>
                
                <div class="checkbox-container">
                    <input type="checkbox" name="privacy" id="privacy" required>
                    <label for="privacy" class="checkbox-label">
                        Acepto la <a href="#">Política de Privacidad</a> y los 
                        <a href="#">Términos de Servicio</a> de Mascotas Sacaba
                    </label>
                </div>
                
                <button type="submit" class="register-button">
                    <i class="fas fa-user-plus"></i>
                    Crear Cuenta
                </button>
            </form>
            
            <div class="login-link">
                ¿Ya tienes una cuenta? <a href="{{ url('login') }}">Inicia sesión aquí</a>
            </div>
            
            <div class="benefits-text">
                Al crear una cuenta, podrás reportar mascotas perdidas, gestionar tus reportes y contactar con otros usuarios de nuestra comunidad.
            </div>
            
            <div class="divider"></div>
            
            <a href="{{ url('auth/google') }}" class="google-button">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Registrarse con Google
            </a>
        </div>
    </div>
</div>

<style>
    .register-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }
    
    .register-box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        overflow: hidden;
    }
    
    .register-header {
        background: white;
        color: #1f2937;
        padding: 2rem 2rem 1rem;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .register-body {
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
    
    .register-button {
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .register-button:hover {
        background: #16a34a;
    }
    
    .divider {
        height: 1px;
        background: #e5e7eb;
        margin: 1.5rem 0;
    }
    
    .login-link {
        text-align: center;
        margin: 1.5rem 0;
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .login-link a {
        color: #22c55e;
        text-decoration: none;
        font-weight: 500;
    }
    
    .login-link a:hover {
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
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    
    .checkbox-container input[type="checkbox"] {
        margin-right: 0.5rem;
        width: 1rem;
        height: 1rem;
        margin-top: 0.25rem;
    }
    
    .checkbox-label {
        font-size: 0.875rem;
        color: #4b5563;
        line-height: 1.4;
    }
    
    .checkbox-label a {
        color: #22c55e;
        text-decoration: none;
    }
    
    .checkbox-label a:hover {
        text-decoration: underline;
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
</style>

<script>
    // Validación básica del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const privacyChecked = document.getElementById('privacy').checked;
        
        if (!privacyChecked) {
            e.preventDefault();
            alert('Por favor, acepta la Política de Privacidad y los Términos de Servicio');
            return;
        }
    });
</script>
@endsection