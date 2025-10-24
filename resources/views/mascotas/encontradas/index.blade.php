@extends('layouts.app')

@section('title', 'Mascotas Encontradas - Mascotas Sacaba')

@section('content')

    <!-- Filtros Rápidos -->
    <section class="py-6 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('mascotas.encontradas.public') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium text-sm transition-all shadow-sm">
                    Todas las Encontradas
                </a>
                <a href="{{ route('mascotas.encontradas.public', ['especie' => 'perro']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-200 transition-all">
                    <i class="fas fa-dog mr-2"></i> Perros
                </a>
                <a href="{{ route('mascotas.encontradas.public', ['especie' => 'gato']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-200 transition-all">
                    <i class="fas fa-cat mr-2"></i> Gatos
                </a>
                
            </div>
        </div>
    </section>

    <!-- Lista de Mascotas Encontradas -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header de la sección -->
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
                    Mascotas Encontradas Recientemente
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Estas mascotas están bajo cuidado temporal esperando a que sus familias las reclamen.
                </p>
            </div>

            <!-- Grid de Mascotas -->
            @if($mascotas->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($mascotas as $mascota)
                    <div class="feature-card group">
                        <div class="p-5">
                            <!-- Badge de reciente -->
                            @if($mascota->created_at->diffInDays(now()) <= 2)
                                <div class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-bold rounded-full mb-3">
                                    <i class="fas fa-clock mr-1"></i> RECIENTE
                                </div>
                            @endif

                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3 shadow-sm">
                                    <i class="fas fa-home text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">{{ $mascota->nombre ?? 'Sin nombre' }}</h3>
                                    <p class="text-xs text-gray-500">{{ $mascota->ubicacion ?? 'Ubicación no especificada' }} • {{ $mascota->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            @if($mascota->foto)
                            <div class="mb-3 overflow-hidden rounded-xl">
                                <img src="{{ asset('storage/' . $mascota->foto) }}" alt="Foto de {{ $mascota->nombre }}" class="pet-image group-hover:scale-105 transition-transform duration-500 w-full h-40 object-cover">
                            </div>
                            @else
                            <div class="mb-3 overflow-hidden rounded-xl bg-gray-200 flex items-center justify-center h-32">
                                <i class="fas fa-paw text-gray-400 text-3xl"></i>
                            </div>
                            @endif
                            
                            <div class="mb-3">
                                <div class="flex flex-wrap gap-1 mb-2">
                                    @if($mascota->especie)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                        <i class="fas fa-dna mr-1"></i> 
                                        {{ $mascota->especie == 'perro' ? 'Perro' : ($mascota->especie == 'gato' ? 'Gato' : $mascota->especie) }}
                                    </span>
                                    @endif
                                    
                                    @if($mascota->raza)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                        <i class="fas fa-dna mr-1"></i> {{ $mascota->raza }}
                                    </span>
                                    @endif
                                    
                                    @if($mascota->color)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                        <i class="fas fa-palette mr-1"></i> {{ $mascota->color }}
                                    </span>
                                    @endif
                                    
                                    @if($mascota->edad)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                        <i class="fas fa-birthday-cake mr-1"></i> {{ $mascota->edad }} años
                                    </span>
                                    @endif
                                </div>
                                
                                @if($mascota->descripcion)
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($mascota->descripcion, 100) }}</p>
                                @endif

                                @if($mascota->fecha_encontrada)
                                    <div class="mt-2 flex items-center text-xs text-blue-600">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        <span>Encontrada el: {{ \Carbon\Carbon::parse($mascota->fecha_encontrada)->format('d/m/Y') }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-xs font-medium px-2 py-1 rounded-full bg-blue-100 text-blue-800">
                                    ENCONTRADA
                                </span>
                                
                                @auth
                                    <a href="{{ route('user.mascotas.show', $mascota) }}" class="text-blue-600 font-medium text-sm hover:text-blue-700 flex items-center transition-colors">
                                        Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-blue-600 font-medium text-sm hover:text-blue-700 flex items-center transition-colors">
                                        Iniciar sesión para ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="flex justify-center">
                    {{ $mascotas->links() }}
                </div>
            @else
                <!-- Estado vacío -->
                <div class="text-center py-8">
                    <div class="bg-white rounded-2xl shadow-sm p-8 max-w-2xl mx-auto border border-gray-100">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-home text-blue-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-blue-800 mb-3">No hay mascotas encontradas registradas</h3>
                        <p class="text-blue-700 mb-4">Actualmente no hay mascotas reportadas como encontradas. Si encontraste una mascota, sé el primero en reportarla para ayudar a reunirla con su familia.</p>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            @auth
                                <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all inline-flex items-center justify-center text-sm">
                                    <i class="fas fa-plus-circle mr-2"></i> Reportar Mascota Encontrada
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all inline-flex items-center justify-center text-sm">
                                    <i class="fas fa-plus-circle mr-2"></i> Reportar Mascota Encontrada
                                </a>
                            @endauth
                            
                            <a href="{{ route('inicio') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold text-center transition-all inline-flex items-center justify-center text-sm">
                                <i class="fas fa-home mr-2"></i> Volver al Inicio
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sección de ayuda -->
            <div class="mt-12 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">¿Encontraste una mascota?</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto text-sm">Sigue estos pasos para darle cuidado temporal y ayudar a encontrar a su familia</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Proporciona cuidado temporal</h4>
                        <p class="text-gray-600 text-xs">Ofrece agua, comida y un lugar seguro mientras buscas a sus dueños.</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-camera text-purple-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Toma fotos claras</h4>
                        <p class="text-gray-600 text-xs">Captura varias fotos desde diferentes ángulos para facilitar la identificación.</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-bullhorn text-orange-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Reporta inmediatamente</h4>
                        <p class="text-gray-600 text-xs">Crea un reporte en nuestra plataforma para alertar a la comunidad.</p>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row justify-center gap-3 mt-8">
                @auth
                    <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all flex items-center justify-center text-sm">
                        <i class="fas fa-plus-circle mr-2"></i> Reportar Mascota Encontrada
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all flex items-center justify-center text-sm">
                        <i class="fas fa-plus-circle mr-2"></i> Reportar Mascota Encontrada
                    </a>
                @endauth
                
                <a href="{{ route('buscar') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold text-center transition-all flex items-center justify-center text-sm">
                    <i class="fas fa-search mr-2"></i> Búsqueda Avanzada
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(59, 130, 246, 0.35);
    }
    
    .btn-secondary {
        background: white;
        color: #3b82f6;
        border: 2px solid #3b82f6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: #eff6ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush