@extends('layouts.app')

@section('title', 'Iniciar Sesión - Mascotas Sacaba')

@section('content')
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
                
                {{-- Campo hidden para redirección --}}
                <input type="hidden" name="redirect_to" value="{{ request('redirect', old('redirect_to', url()->previous())) }}">
                
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

<style>
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
</style>
@endsection