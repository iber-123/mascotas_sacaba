@extends('layouts.app')

@section('title', 'Búsqueda de Mascotas - Sacaba')

@section('content')
    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Búsqueda de Mascotas</h1>
            <p class="text-gray-600">Explora todos los reportes de mascotas perdidas y encontradas en Sacaba. Usa los filtros para encontrar información específica.</p>
        </div>

        <!-- Filtros de Búsqueda -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Filtros de Búsqueda</h2>
            
            <form action="{{ route('buscar') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select name="estado" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="">Todos los estados</option>
                            <option value="perdida" {{ request('estado') == 'perdida' ? 'selected' : '' }}>Perdida</option>
                            <option value="encontrada" {{ request('estado') == 'encontrada' ? 'selected' : '' }}>Encontrada</option>
                            <option value="adopcion" {{ request('estado') == 'adopcion' ? 'selected' : '' }}>En adopción</option>
                        </select>
                    </div>
                    
                    <!-- Especie -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Especie</label>
                        <select name="especie" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="">Todas las especies</option>
                            <option value="perro" {{ request('especie') == 'perro' ? 'selected' : '' }}>Perro</option>
                            <option value="gato" {{ request('especie') == 'gato' ? 'selected' : '' }}>Gato</option>
                            <option value="ave" {{ request('especie') == 'ave' ? 'selected' : '' }}>Ave</option>
                            <option value="otro" {{ request('especie') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    
                    <!-- Tamaño -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tamaño</label>
                        <select name="tamaño" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="">Todos los tamaños</option>
                            <option value="pequeño" {{ request('tamaño') == 'pequeño' ? 'selected' : '' }}>Pequeño</option>
                            <option value="mediano" {{ request('tamaño') == 'mediano' ? 'selected' : '' }}>Mediano</option>
                            <option value="grande" {{ request('tamaño') == 'grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                    </div>
                    
                    <!-- Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                        <input type="text" name="color" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej: negro, café, blanco..." value="{{ request('color') }}">
                    </div>
                    
                    <!-- Ubicación -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                        <input type="text" name="ubicacion" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Ej: Centro, Villa Túnari..." value="{{ request('ubicacion') }}">
                    </div>
                </div>
                
                <!-- Búsqueda por texto -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar por nombre, raza o descripción</label>
                    <div class="flex space-x-2">
                        <input type="text" name="q" class="flex-1 p-2 border border-gray-300 rounded-lg" placeholder="Escribe para buscar..." value="{{ request('q') }}">
                        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg font-medium hover:bg-green-600 transition-colors inline-flex items-center">
                            <i class="fas fa-search mr-2"></i>Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Resultados -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            @if($mascotas->count())
                <!-- Información de búsqueda -->
                @if(request()->hasAny(['q', 'estado', 'especie', 'tamaño', 'color', 'ubicacion']))
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-blue-800">Resultados de búsqueda</h3>
                            <p class="text-blue-600 text-sm">
                                Se encontraron {{ $mascotas->total() }} mascotas
                                @if(request('q'))
                                    para "{{ request('q') }}"
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('buscar') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-times mr-1"></i> Limpiar filtros
                        </a>
                    </div>
                </div>
                @endif

                <!-- Grid de mascotas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($mascotas as $mascota)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md">
                        @if($mascota->foto)
                        <img src="{{ asset('storage/' . $mascota->foto) }}" alt="{{ $mascota->nombre }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-paw text-gray-400 text-4xl"></i>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-gray-800 text-lg">{{ $mascota->nombre }}</h3>
                                <span class="text-xs font-medium px-2 py-1 rounded-full 
                                    @if($mascota->estado == 'perdida') bg-red-100 text-red-800
                                    @elseif($mascota->estado == 'encontrada') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($mascota->estado) }}
                                </span>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <i class="fas fa-paw mr-2 text-gray-400"></i>
                                    <span>{{ $mascota->especie ?? 'No especificado' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-dna mr-2 text-gray-400"></i>
                                    <span>{{ $mascota->raza ?? 'No especificada' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                    <span>{{ $mascota->ubicacion ?? 'No especificada' }}</span>
                                </div>
                            </div>
                            
                            @if($mascota->descripcion)
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($mascota->descripcion, 100) }}</p>
                            @endif
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    {{ $mascota->created_at->diffForHumans() }}
                                </span>
                                <!-- Enlaces según estado -->
                                @if($mascota->estado == 'perdida')
                                    <a href="{{ route('mascotas.perdidas.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center">
                                        Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @elseif($mascota->estado == 'encontrada')
                                    <a href="{{ route('mascotas.encontradas.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center">
                                        Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @else
                                    <a href="{{ route('mascotas.adopcion.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center">
                                        Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-8">
                    {{ $mascotas->links() }}
                </div>

            @else
                <!-- Estado vacío -->
                <div class="text-center py-12">
                    <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">
                        @if(request()->hasAny(['q', 'estado', 'especie', 'tamaño', 'color', 'ubicacion']))
                            No se encontraron mascotas
                        @else
                            No hay mascotas registradas
                        @endif
                    </h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['q', 'estado', 'especie', 'tamaño', 'color', 'ubicacion']))
                            Intenta ajustar tus filtros de búsqueda
                        @else
                            Sé el primero en reportar una mascota
                        @endif
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                        @if(request()->hasAny(['q', 'estado', 'especie', 'tamaño', 'color', 'ubicacion']))
                            <a href="{{ route('buscar') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-colors text-center">
                                Limpiar Filtros
                            </a>
                        @endif
                        
                        @auth
                            <a href="{{ route('user.mascotas.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg font-medium hover:bg-green-600 transition-colors text-center">
                                Reportar Mascota
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg font-medium hover:bg-green-600 transition-colors text-center">
                                Iniciar Sesión para Reportar
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection