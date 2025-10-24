@extends('layouts.app')

@section('title', 'Mascotas en Adopción - Mascotas Sacaba')

@section('content')
    
    <!-- Filtros Rápidos -->
    <section class="py-6 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('mascotas.adopcion.public') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg font-medium text-sm transition-all shadow-sm">
                    Todas en Adopción
                </a>
                <a href="{{ route('mascotas.adopcion.public', ['especie' => 'perro']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-200 transition-all">
                    <i class="fas fa-dog mr-2"></i> Perros
                </a>
                <a href="{{ route('mascotas.adopcion.public', ['especie' => 'gato']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-200 transition-all">
                    <i class="fas fa-cat mr-2"></i> Gatos
                </a>
            </div>
        </div>
    </section>

    <!-- Lista de Mascotas en Adopción -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header de la sección -->
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">
                    Mascotas Buscando Hogar
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Conoce a estas adorables mascotas que están esperando por una familia que les brinde amor y cuidado.
                </p>
            </div>

            <!-- Grid de Mascotas -->
            @if($mascotas->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($mascotas as $mascota)
                    <div class="feature-card group">
                        <div class="p-5">
                            <!-- Badge de especial -->
                            @if($mascota->created_at->diffInDays(now()) <= 7)
                                <div class="inline-flex items-center px-2 py-1 bg-purple-500 text-white text-xs font-bold rounded-full mb-3">
                                    <i class="fas fa-star mr-1"></i> NUEVO
                                </div>
                            @endif

                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3 shadow-sm">
                                    <i class="fas fa-heart text-purple-600 text-sm"></i>
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

                                    @if($mascota->sexo)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                        <i class="fas {{ $mascota->sexo == 'macho' ? 'fa-mars' : 'fa-venus' }} mr-1"></i> 
                                        {{ ucfirst($mascota->sexo) }}
                                    </span>
                                    @endif
                                </div>
                                
                                @if($mascota->descripcion)
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($mascota->descripcion, 100) }}</p>
                                @endif

                                @if($mascota->tamaño)
                                    <div class="mt-2 flex items-center text-xs text-purple-600">
                                        <i class="fas fa-ruler mr-2"></i>
                                        <span>Tamaño: {{ ucfirst($mascota->tamaño) }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-xs font-medium px-2 py-1 rounded-full bg-purple-100 text-purple-800">
                                    EN ADOPCIÓN
                                </span>
                                
                                @auth
                                    <a href="{{ route('user.mascotas.show', $mascota) }}" class="text-purple-600 font-medium text-sm hover:text-purple-700 flex items-center transition-colors">
                                        Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-purple-600 font-medium text-sm hover:text-purple-700 flex items-center transition-colors">
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
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heart text-purple-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-purple-800 mb-3">No hay mascotas en adopción registradas</h3>
                        <p class="text-purple-700 mb-4">Actualmente no hay mascotas disponibles para adopción. Si tienes una mascota que necesita un nuevo hogar, sé el primero en ofrecerla en adopción.</p>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            @auth
                                <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all inline-flex items-center justify-center text-sm">
                                    <i class="fas fa-plus-circle mr-2"></i> Ofrecer Mascota
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all inline-flex items-center justify-center text-sm">
                                    <i class="fas fa-plus-circle mr-2"></i> Ofrecer Mascota
                                </a>
                            @endauth
                            
                            <a href="{{ route('inicio') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold text-center transition-all inline-flex items-center justify-center text-sm">
                                <i class="fas fa-home mr-2"></i> Volver al Inicio
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sección de beneficios de adoptar -->
            <div class="mt-12 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">¿Por qué adoptar?</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto text-sm">La adopción cambia vidas. Conoce los beneficios de darle un hogar a una mascota necesitada.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-life-ring text-green-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Salvas una vida</h4>
                        <p class="text-gray-600 text-xs">Le das una segunda oportunidad a un animal que necesita amor.</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-money-bill-wave text-blue-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Más económico</h4>
                        <p class="text-gray-600 text-xs">El costo de adopción es menor que comprar una mascota.</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-heartbeat text-orange-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Mascotas saludables</h4>
                        <p class="text-gray-600 text-xs">Muchas mascotas en adopción ya están vacunadas y esterilizadas.</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-smile text-purple-600 text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Gratitud eterna</h4>
                        <p class="text-gray-600 text-xs">Las mascotas adoptadas suelen ser muy agradecidas con sus nuevas familias.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6">
                    @auth
                        <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all flex items-center justify-center text-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Ofrecer en Adopción
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold text-center transition-all flex items-center justify-center text-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Ofrecer en Adopción
                        </a>
                    @endauth
                    
                    <a href="{{ route('buscar') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold text-center transition-all flex items-center justify-center text-sm">
                        <i class="fas fa-search mr-2"></i> Búsqueda Avanzada
                    </a>
                </div>
                
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(139, 92, 246, 0.25);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(139, 92, 246, 0.35);
    }
    
    .btn-secondary {
        background: white;
        color: #8b5cf6;
        border: 2px solid #8b5cf6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: #faf5ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush