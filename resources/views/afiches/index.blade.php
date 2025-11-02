@extends('layouts.app')

@section('title', 'Mis Afiches - Mascotas Sacaba')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mis Afiches</h1>
            <p class="text-gray-600">Gestiona y descarga tus afiches creados</p>
        </div>

        @if($afiches->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($afiches as $afiche)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $afiche->titulo }}</h3>
                        <span class="text-xs px-2 py-1 rounded-full 
                            @if($afiche->mascota->estado == 'perdida') bg-red-100 text-red-800
                            @elseif($afiche->mascota->estado == 'encontrada') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($afiche->mascota->estado) }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-gray-600 text-sm mb-2">
                            <strong>Mascota:</strong> {{ $afiche->mascota->nombre }}
                        </p>
                        <p class="text-gray-600 text-sm mb-2">
                            <strong>Plantilla:</strong> {{ ucfirst($afiche->plantilla) }}
                        </p>
                        <p class="text-gray-500 text-xs">
                            Creado: {{ $afiche->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('afiches.download.pdf', $afiche) }}" 
                           class="flex-1 bg-red-500 hover:bg-red-600 text-white text-center py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-file-pdf mr-1"></i> PDF
                        </a>
                        <a href="{{ route('afiches.download.image', $afiche) }}" 
                           class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-image mr-1"></i> Imagen
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="bg-white rounded-2xl shadow-sm p-8 max-w-md mx-auto">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-image text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">No tienes afiches creados</h3>
                    <p class="text-gray-600 mb-4">Crea tu primer afiche para una mascota perdida o en adopción.</p>
                    <a href="{{ route('afiches.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold inline-flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Crear Primer Afiche
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.btn-primary {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(16, 185, 129, 0.35);
}
</style>
@endsection
