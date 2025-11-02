@extends('layouts.app')

@section('title', 'Afiche - ' . $afiche->titulo)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Botón Volver Atrás -->
        <div class="mb-6">
            <a href="{{ route('afiches.index') }}" 
               class="inline-flex items-center text-green-600 hover:text-green-700 font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a Mis Afiches
            </a>
        </div>

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Vista Previa del Afiche</h1>
            <p class="text-gray-600">Puedes tomar captura de pantalla para guardar como imagen</p>
        </div>

        <!-- Afiche para captura -->
        <div id="afiche-imagen" class="bg-white rounded-2xl shadow-2xl p-8 border-4" style="border-color: {{ $afiche->color_principal }};">
            <!-- Título -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold" style="color: {{ $afiche->color_principal }};">{{ $afiche->titulo }}</h2>
            </div>

            <!-- Información de la Mascota -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-semibold mb-3" style="color: {{ $afiche->color_principal }};">Información de la Mascota</h3>
                    <div class="space-y-2 text-gray-700">
                        <p><strong>Nombre:</strong> {{ $afiche->mascota->nombre }}</p>
                        <p><strong>Especie:</strong> {{ $afiche->mascota->especie }}</p>
                        <p><strong>Raza:</strong> {{ $afiche->mascota->raza ?? 'No especificada' }}</p>
                        <p><strong>Color:</strong> {{ $afiche->mascota->color ?? 'No especificado' }}</p>
                        <p><strong>Edad:</strong> {{ $afiche->mascota->edad ?? 'No especificada' }}</p>
                    </div>
                </div>

                @if($afiche->mascota->foto)
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $afiche->mascota->foto) }}" 
                         alt="{{ $afiche->mascota->nombre }}" 
                         class="w-48 h-48 object-cover rounded-2xl border-2" 
                         style="border-color: {{ $afiche->color_principal }};">
                </div>
                @endif
            </div>

            <!-- Descripción -->
            @if($afiche->descripcion)
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2" style="color: {{ $afiche->color_principal }};">Descripción</h3>
                <p class="text-gray-700 leading-relaxed">{{ $afiche->descripcion }}</p>
            </div>
            @endif

            <!-- Recompensa -->
            @if($afiche->mostrar_recompensa && $afiche->recompensa)
            <div class="mb-6 p-4 rounded-xl bg-yellow-50 border border-yellow-200">
                <h3 class="text-lg font-semibold text-yellow-800 mb-1">Recompensa</h3>
                <p class="text-yellow-700 font-bold text-xl">{{ $afiche->recompensa }}</p>
            </div>
            @endif

            <!-- Contacto -->
            @if($afiche->mostrar_contacto)
            <div class="mt-8 p-4 rounded-xl bg-gray-100">
                <h3 class="text-lg font-semibold mb-2" style="color: {{ $afiche->color_principal }};">Contacto</h3>
                <p class="text-gray-700 text-xl font-bold">{{ $afiche->telefono_contacto }}</p>
                <p class="text-gray-600 text-sm mt-1">Por favor contactar si tiene información</p>
            </div>
            @endif
        </div>

        <!-- Instrucciones -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">
                <i class="fas fa-info-circle mr-1"></i>
                Toma captura de pantalla (Ctrl+Shift+S) para guardar como imagen
            </p>
            <div class="mt-4 flex justify-center space-x-4">
                <a href="{{ route('afiches.download.pdf', $afiche) }}" 
                   class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-xl font-semibold transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i> Descargar PDF
                </a>
                <a href="{{ route('afiches.create') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-xl font-semibold transition-colors">
                    <i class="fas fa-plus mr-2"></i> Descargar imagen
                </a>
            </div>
        </div>
    </div>
</div>
@endsection