@extends('layouts.app')

@section('title', 'Búsqueda de Mascotas - Sacaba')

@push('styles')
<style>
    .filter-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .btn-primary {
        background-color: #22c55e;
        color: white;
    }
    .btn-primary:hover {
        background-color: #16a34a;
    }
    .btn-secondary {
        background-color: white;
        color: #22c55e;
        border: 2px solid #22c55e;
    }
    .btn-secondary:hover {
        background-color: #f0fdf4;
    }
    .filter-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        background-color: white;
        cursor: pointer;
    }
    .filter-select:focus {
        outline: none;
        border-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
    }
    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
    }
    .search-input:focus {
        outline: none;
        border-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
    }
    .state-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .state-btn.active {
        background-color: #22c55e;
        color: white;
    }
    .state-btn:not(.active) {
        background-color: #f9fafb;
        color: #6b7280;
    }
    .state-btn:not(.active):hover {
        background-color: #f3f4f6;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6b7280;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #d1d5db;
    }
    .mascota-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .mascota-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    .mascota-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
</style>
@endpush

@section('content')
    <!-- Contenido Principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Búsqueda de Mascotas</h1>
            <p class="text-gray-600">Explora todos los reportes de mascotas perdidas y encontradas en Sacaba. Usa los filtros para encontrar información específica.</p>
        </div>

        <!-- Filtros de Búsqueda -->
        <div class="filter-card p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Filtros de Búsqueda</h2>
            
            <form action="{{ route('buscar') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select name="estado" class="filter-select">
                            <option value="">Todos los estados</option>
                            <option value="perdida" {{ request('estado') == 'perdida' ? 'selected' : '' }}>Perdida</option>
                            <option value="encontrada" {{ request('estado') == 'encontrada' ? 'selected' : '' }}>Encontrada</option>
                            <option value="adopcion" {{ request('estado') == 'adopcion' ? 'selected' : '' }}>En adopción</option>
                        </select>
                    </div>
                    
                    <!-- Tipo de Animal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Especie</label>
                        <select name="especie" class="filter-select">
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
                        <select name="tamaño" class="filter-select">
                            <option value="">Todos los tamaños</option>
                            <option value="pequeño" {{ request('tamaño') == 'pequeño' ? 'selected' : '' }}>Pequeño</option>
                            <option value="mediano" {{ request('tamaño') == 'mediano' ? 'selected' : '' }}>Mediano</option>
                            <option value="grande" {{ request('tamaño') == 'grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                    </div>
                    
                    <!-- Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                        <input type="text" name="color" class="search-input" placeholder="Ej: negro, café, blanco..." value="{{ request('color') }}">
                    </div>
                    
                    <!-- Ubicación -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                        <input type="text" name="ubicacion" class="search-input" placeholder="Ej: Centro, Villa Túnari..." value="{{ request('ubicacion') }}">
                    </div>
                </div>
                
                <!-- Búsqueda por texto -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar por nombre, raza o descripción</label>
                    <div class="flex space-x-2">
                        <input type="text" name="q" class="search-input flex-1" placeholder="Escribe para buscar..." value="{{ request('q') }}">
                        <!-- BOTÓN DE BÚSQUEDA PÚBLICO - SIN RESTRICCIÓN DE LOGIN -->
                        <button type="submit" class="px-6 py-3 bg-green-500 text-white rounded-lg font-medium hover:bg-green-600 transition-colors inline-flex items-center">
                            <i class="fas fa-search mr-2"></i>Buscar
                        </button>
                    </div>
                </div>
                
                <!-- Botones de estado rápido -->
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="state-btn active" data-estado="">Todos</button>
                    <button type="button" class="state-btn" data-estado="perdida">Mascotas perdidas</button>
                    <button type="button" class="state-btn" data-estado="encontrada">Mascotas encontradas</button>
                    <button type="button" class="state-btn" data-estado="adopcion">En adopción</button>
                </div>
            </form>
        </div>
        
        <!-- Resultados -->
        <div class="filter-card p-6">
            @if(isset($mascotas) && $mascotas->count())
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
                    <div class="mascota-card">
                        @if($mascota->foto)
                        <img src="{{ asset('storage/' . $mascota->foto) }}" alt="{{ $mascota->nombre }}" class="mascota-image">
                        @else
                        <div class="mascota-image bg-gray-200 flex items-center justify-center">
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
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($mascota->descripcion, 100) }}</p>
                            @endif
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    {{ $mascota->created_at->diffForHumans() }}
                                </span>
                                <!-- ENLACE CORREGIDO PARA VER DETALLES -->
                                @auth
                                    <a href="{{ route('user.mascotas.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center">
                                        Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center">
                                        Iniciar sesión para ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @endauth
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
                <div class="empty-state">
                    <i class="fas fa-search"></i>
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
                        
                        <!-- Botón de reportar con verificación de autenticación -->
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

@push('scripts')
<script>
    // Funcionalidad para los botones de estado
    document.addEventListener('DOMContentLoaded', function() {
        const stateButtons = document.querySelectorAll('.state-btn');
        const estadoSelect = document.querySelector('select[name="estado"]');
        
        stateButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover la clase active de todos los botones
                stateButtons.forEach(btn => btn.classList.remove('active'));
                // Agregar la clase active al botón clickeado
                this.classList.add('active');
                
                // Actualizar el select de estado
                const estado = this.getAttribute('data-estado');
                estadoSelect.value = estado;
                
                // Enviar el formulario automáticamente
                this.closest('form').submit();
            });
        });
        
        // Inicializar el botón activo según el estado actual
        const currentEstado = estadoSelect.value;
        stateButtons.forEach(button => {
            if (button.getAttribute('data-estado') === currentEstado) {
                button.classList.add('active');
            }
        });
        
        // Auto-submit en cambio de selects
        const filterSelects = document.querySelectorAll('.filter-select');
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });
        
        // Auto-submit en input de búsqueda después de un tiempo
        let searchTimeout;
        const searchInput = document.querySelector('input[name="q"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.closest('form').submit();
                }, 1000); // 1 segundo de delay
            });
        }
    });
</script>
@endpush