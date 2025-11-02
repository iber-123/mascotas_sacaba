@extends('layouts.app')

@section('title', 'Mascotas Perdidas Sacaba - Encuentra a tu compañero')

@section('content')

    <!-- Sección de Mascotas Recientes Mejorada -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 section-title mx-auto">Mascotas Recientes</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Últimas mascotas registradas por nuestra comunidad</p>
            </div>

            @if(isset($mascotas) && $mascotas->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mascotas as $mascota)
                <div class="feature-card group">
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3 
                                @if($mascota->estado == 'perdida') bg-red-100
                                @elseif($mascota->estado == 'encontrada') bg-blue-100
                                @else bg-green-100 @endif shadow-sm">
                                <i class="
                                    @if($mascota->estado == 'perdida') fas fa-search-location text-red-600
                                    @elseif($mascota->estado == 'encontrada') fas fa-home text-blue-600
                                    @else fas fa-heart text-green-600 @endif text-sm">
                                </i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $mascota->nombre }}</h3>
                                <p class="text-xs text-gray-500">{{ $mascota->ubicacion ?? 'Ubicación no especificada' }} • {{ $mascota->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        @if($mascota->foto)
                        <div class="mb-3 overflow-hidden rounded-xl">
                            <img src="{{ asset('storage/' . $mascota->foto) }}" alt="Foto de {{ $mascota->nombre }}" class="pet-image group-hover:scale-105 transition-transform duration-500 w-full h-48 object-cover">
                        </div>
                        @else
                        <div class="mb-3 overflow-hidden rounded-xl bg-gray-200 flex items-center justify-center h-32">
                            <i class="fas fa-paw text-gray-400 text-3xl"></i>
                        </div>
                        @endif
                        
                        <div class="mb-3">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                    <i class="fas fa-dna mr-1"></i> {{ $mascota->raza ?? 'No especificada' }}
                                </span>
                                <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                    <i class="fas fa-palette mr-1"></i> {{ $mascota->color ?? 'No especificado' }}
                                </span>
                                @if($mascota->edad)
                                <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                    <i class="fas fa-birthday-cake mr-1"></i> {{ $mascota->edad }} años
                                </span>
                                @endif
                            </div>
                            
                            @if($mascota->descripcion)
                                <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($mascota->descripcion, 100) }}</p>
                            @endif
                        </div>
                        
                        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                            <span class="text-xs font-medium px-2 py-1 rounded-full 
                                @if($mascota->estado == 'perdida') bg-red-100 text-red-800
                                @elseif($mascota->estado == 'encontrada') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($mascota->estado) }}
                            </span>
                            
                            <!-- ENLACE MODIFICADO: Ahora usa rutas públicas según el estado -->
                            @if($mascota->estado == 'perdida')
                                <a href="{{ route('mascotas.perdidas.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center transition-colors">
                                    Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            @elseif($mascota->estado == 'encontrada')
                                <a href="{{ route('mascotas.encontradas.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center transition-colors">
                                    Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            @else
                                <a href="{{ route('mascotas.adopcion.show', $mascota) }}" class="text-green-600 font-medium text-sm hover:text-green-700 flex items-center transition-colors">
                                    Ver detalles <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="bg-white rounded-2xl shadow-sm p-6 max-w-md mx-auto border border-gray-100">
                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-info-circle text-yellow-500 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-yellow-800 mb-2">No hay mascotas registradas</h3>
                    <p class="text-yellow-700 mb-3 text-sm">Sé el primero en registrar una mascota perdida o encontrada.</p>
                    @auth
                        <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-5 py-2 rounded-xl font-medium inline-flex items-center text-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Registrar Primera Mascota
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary px-5 py-2 rounded-xl font-medium inline-flex items-center text-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Registrar Primera Mascota
                        </a>
                    @endauth
                </div>
            </div>
            @endif
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('buscar') }}" class="btn-secondary px-8 py-4 rounded-xl font-semibold text-center transition-all inline-flex items-center">
                <i class="fas fa-list mr-3"></i> Ver Todas las Mascotas
            </a>
        </div>
    </section>

    <!-- Sección de Llamada a la Acción Mejorada -->
    <section class="py-12 bg-gradient-to-br from-green-50 to-blue-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-green-300 rounded-full"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-blue-300 rounded-full"></div>
            <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-yellow-300 rounded-full"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">¿Perdiste a tu mascota o encontraste una?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Cada minuto cuenta. Nuestra comunidad está lista para ayudarte a reunirte con tu compañero o encontrarle un hogar a una mascota necesitada.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ route('user.mascotas.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold transition-all inline-flex items-center justify-center shadow-lg text-sm">
                        <i class="fas fa-search-location mr-2"></i> Registrar Mascota Perdida
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold transition-all inline-flex items-center justify-center shadow-lg text-sm">
                        <i class="fas fa-search-location mr-2"></i> Registrar Mascota Perdida
                    </a>
                @endauth

                @auth
                    <a href="{{ route('user.mascotas.create') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold transition-all inline-flex items-center justify-center text-sm">
                        <i class="fas fa-home mr-2"></i> Registrar Mascota Encontrada
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary px-6 py-3 rounded-xl font-semibold transition-all inline-flex items-center justify-center text-sm">
                        <i class="fas fa-home mr-2"></i> Registrar Mascota Encontrada
                    </a>
                @endauth
            </div>
        </div>
    </section>


    <!-- Botón flotante de Buscar Mascotas -->
    <a href="{{ route('buscar') }}" id="floatingSearchBtn" class="floating-search-btn">
        <i class="fas fa-search"></i>
        <span class="hidden md:inline">Buscar Mascotas</span>
    </a>

    <style>
    .floating-search-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        padding: 12px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 1000;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .floating-search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .floating-search-btn:active {
        transform: translateY(-1px);
    }

    /* Para pantallas móviles */
    @media (max-width: 768px) {
        .floating-search-btn {
            bottom: 15px;
            right: 15px;
            padding: 14px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            justify-content: center;
        }
    }

    /* Efecto de aparición suave */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .floating-search-btn {
        animation: fadeInUp 0.5s ease-out;
    }
    </style>
@endsection