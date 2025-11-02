@extends('layouts.app')

@section('title', 'Crear Afiche - Mascotas Sacaba')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-green-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg mb-4">
                <i class="fas fa-file-image text-white text-2xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-3 bg-gradient-to-r from-gray-900 to-emerald-800 bg-clip-text text-transparent">
                Crear Afiche
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Diseña un afiche profesional para tu mascota perdida o en adopción
            </p>
        </div>

        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center">
                <i class="fas fa-check-circle text-green-500 text-lg mr-3"></i>
                <div>
                    <p class="font-semibold">¡Éxito!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Form Container -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/60 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-paw text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Información del Afiche</h2>
                        <p class="text-green-100 text-sm">Completa los datos para crear tu afiche</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <form action="{{ route('afiches.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Selección de Mascota -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-paw text-green-600 text-sm"></i>
                            </div>
                            <label class="block text-lg font-semibold text-gray-800">Selecciona una Mascota</label>
                        </div>
                        <select name="mascota_id" required 
                                class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-green-300">
                            <option value="" class="text-gray-400">-- Selecciona una mascota --</option>
                            @foreach($mascotas as $mascota)
                                <option value="{{ $mascota->id }}" class="py-2">
                                    {{ $mascota->nombre }} - {{ $mascota->especie }} ({{ $mascota->estado }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Información del Afiche -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Título -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-heading text-blue-600 text-sm"></i>
                                </div>
                                <label class="block text-lg font-semibold text-gray-800">Título del Afiche</label>
                            </div>
                            <input type="text" name="titulo" required 
                                   class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-blue-300"
                                   placeholder="Ej: Se busca - Max perdido en Sacaba"
                                   value="{{ old('titulo') }}">
                        </div>

                        <!-- Teléfono de Contacto -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone text-purple-600 text-sm"></i>
                                </div>
                                <label class="block text-lg font-semibold text-gray-800">Teléfono de Contacto</label>
                            </div>
                            <input type="text" name="telefono_contacto" required 
                                   class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-purple-300"
                                   placeholder="+591 123 456 78"
                                   value="{{ old('telefono_contacto', auth()->user()->telefono ?? '') }}">
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-align-left text-amber-600 text-sm"></i>
                            </div>
                            <label class="block text-lg font-semibold text-gray-800">Descripción</label>
                        </div>
                        <textarea name="descripcion" rows="4"
                                  class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-amber-300 resize-none"
                                  placeholder="Describe detalles importantes sobre la mascota (características especiales, lugar donde se perdió, comportamiento, etc.)">{{ old('descripcion') }}</textarea>
                    </div>

                    <!-- Recompensa -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-gift text-yellow-600 text-sm"></i>
                            </div>
                            <label class="block text-lg font-semibold text-gray-800">Recompensa</label>
                        </div>
                        <div class="bg-yellow-50/50 border-2 border-yellow-100 rounded-2xl p-6 space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="mostrar_recompensa" id="mostrar_recompensa" 
                                       class="w-5 h-5 text-yellow-500 border-2 border-gray-300 rounded focus:ring-yellow-500 focus:ring-2" 
                                       {{ old('mostrar_recompensa') ? 'checked' : '' }}>
                                <label for="mostrar_recompensa" class="ml-3 text-gray-700 font-medium">Ofrecer recompensa</label>
                            </div>
                            <input type="text" name="recompensa" 
                                   class="w-full px-4 py-3 border border-yellow-200 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 bg-white transition-all duration-300"
                                   placeholder="Ej: Bs. 500 o Información importante"
                                   value="{{ old('recompensa') }}">
                        </div>
                    </div>

                    <!-- Diseño del Afiche -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-palette text-pink-600 text-sm"></i>
                            </div>
                            <label class="block text-lg font-semibold text-gray-800">Diseño del Afiche</label>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Plantilla -->
                            <div class="space-y-4">
                                <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">Plantilla</label>
                                <select name="plantilla" class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-pink-300">
                                    <option value="default" {{ old('plantilla', 'default') == 'default' ? 'selected' : '' }}>🎨 Default</option>
                                    <option value="moderno" {{ old('plantilla') == 'moderno' ? 'selected' : '' }}>🚀 Moderno</option>
                                    <option value="clasico" {{ old('plantilla') == 'clasico' ? 'selected' : '' }}>📜 Clásico</option>
                                    <option value="urgente" {{ old('plantilla') == 'urgente' ? 'selected' : '' }}>🚨 Urgente</option>
                                </select>
                            </div>

                            <!-- Color Principal -->
                            <div class="space-y-4">
                                <label class="block text-sm font-semibold text-gray-700 uppercase tracking-wide">Color Principal</label>
                                <div class="flex items-center space-x-4">
                                    <input type="color" name="color_principal" 
                                           class="w-16 h-16 border-2 border-gray-200 rounded-2xl cursor-pointer hover:scale-105 transition-transform"
                                           value="{{ old('color_principal', '#10b981') }}">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600">Selecciona el color principal para tu afiche</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opciones de Contacto -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-eye text-indigo-600 text-sm"></i>
                            </div>
                            <label class="block text-lg font-semibold text-gray-800">Opciones de Visualización</label>
                        </div>
                        <div class="bg-indigo-50/50 border-2 border-indigo-100 rounded-2xl p-6">
                            <div class="flex items-center">
                                <input type="checkbox" name="mostrar_contacto" id="mostrar_contacto" 
                                       class="w-5 h-5 text-indigo-500 border-2 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2" 
                                       {{ old('mostrar_contacto', true) ? 'checked' : '' }}>
                                <label for="mostrar_contacto" class="ml-3 text-gray-700 font-medium">
                                    Mostrar información de contacto en el afiche
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                        <a href="{{ url()->previous() }}" 
                           class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 transition-all duration-300 hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </a>
                        <button type="submit" 
                                class="px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-2xl font-semibold transition-all duration-300 hover:scale-105 hover:shadow-2xl flex items-center space-x-2 group">
                            <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                            <span>Crear Afiche</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
    }
    
    .checkbox-container input:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
    }
</style>
@endsection