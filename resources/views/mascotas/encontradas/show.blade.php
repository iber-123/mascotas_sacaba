@extends('layouts.app')

@section('title', $mascota->nombre . ' - Mascota Encontrada')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-teal-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Botón Volver Atrás -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver Atrás
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información Principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Tarjeta de Información -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-info-circle mr-3"></i>
                            Información de {{ $mascota->nombre }}
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-paw text-green-600 text-lg w-6"></i>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Especie</p>
                                        <p class="font-semibold text-gray-900">{{ $mascota->especie }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-dna text-green-600 text-lg w-6"></i>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Raza</p>
                                        <p class="font-semibold text-gray-900">{{ $mascota->raza ?? 'No especificada' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-birthday-cake text-green-600 text-lg w-6"></i>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Edad</p>
                                        <p class="font-semibold text-gray-900">{{ $mascota->edad ? $mascota->edad . ' años' : 'No especificada' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-venus-mars text-green-600 text-lg w-6"></i>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Sexo</p>
                                        <p class="font-semibold text-gray-900">{{ $mascota->sexo ?? 'No especificado' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-palette text-green-600 text-lg w-6"></i>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Color</p>
                                        <p class="font-semibold text-gray-900">{{ $mascota->color ?? 'No especificado' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                    <i class="fas fa-ruler text-green-600 text-lg w-6"></i>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Tamaño</p>
                                        <p class="font-semibold text-gray-900">{{ $mascota->tamaño ?? 'No especificado' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-map-marker-alt text-green-600 text-lg w-6"></i>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600">Lugar donde fue encontrado</p>
                                    <p class="font-semibold text-gray-900">{{ $mascota->ubicacion ?? 'No especificada' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($mascota->descripcion)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-align-left text-green-600 mr-2"></i>
                                Descripción
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <p class="text-gray-700 leading-relaxed">{{ $mascota->descripcion }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sección de Compartir en Redes Sociales -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-share-alt mr-3"></i>
                            Ayuda a {{ $mascota->nombre }} a encontrar ayuda temporal
                        </h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 mb-6 text-center">
                            Comparte esta publicación para ayudar a {{ $mascota->nombre }} a encontrar un hogar temporal
                        </p>
                        
                        <!-- Botones de redes sociales solo con iconos -->
                        <div class="flex justify-center space-x-6">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&quote=Encontré a {{ $mascota->nombre }} y necesita hogar temporal. ¿Puedes ayudar?"
                               target="_blank" 
                               rel="noopener"
                               class="w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>

                            <!-- Instagram -->
                            <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}"
                               target="_blank"
                               rel="noopener"
                               class="w-14 h-14 bg-gradient-to-br from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/?text=Encontré a {{ $mascota->nombre }} y necesita hogar temporal. ¿Puedes ayudar? - {{ urlencode(url()->current()) }}"
                               target="_blank"
                               rel="noopener"
                               class="w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>

                            <!-- Telegram -->
                            <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text=Encontré a {{ $mascota->nombre }} y necesita hogar temporal. ¿Puedes ayudar?"
                               target="_blank"
                               rel="noopener"
                               class="w-14 h-14 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fab fa-telegram-plane text-xl"></i>
                            </a>

                            <!-- Copiar Enlace -->
                            <button onclick="copiarEnlace()"
                                    class="w-14 h-14 bg-purple-600 hover:bg-purple-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg cursor-pointer">
                                <i class="fas fa-link text-xl"></i>
                            </button>
                        </div>

                        <!-- Copiar enlace (input oculto) -->
                        <div class="mt-6 hidden">
                            <div class="flex items-center justify-center space-x-3">
                                <input type="text" 
                                       id="shareUrl" 
                                       value="{{ url()->current() }}" 
                                       readonly
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <p id="copyMessage" class="text-green-600 text-sm text-center mt-2 hidden">
                                <i class="fas fa-check mr-1"></i>Enlace copiado al portapapeles
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Foto de la Mascota -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        @if($mascota->foto)
                            <img src="{{ asset('storage/' . $mascota->foto) }}" 
                                 alt="{{ $mascota->nombre }}" 
                                 class="w-full h-64 object-cover rounded-xl shadow-md mb-4">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-paw text-gray-400 text-6xl"></i>
                            </div>
                        @endif
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $mascota->nombre }}</h3>
                            <p class="text-gray-600 mt-2">Reportado el {{ $mascota->created_at->format('d/m/Y') }}</p>
                            <div class="mt-3 inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                <i class="fas fa-home mr-1"></i>
                                Encontrado hace {{ $mascota->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acción Principal - ACTUALIZADO CON NUEVO SISTEMA DE MENSAJERÍA -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="text-center">
                        @if(Auth::check() && Auth::id() === $mascota->user_id)
                            <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                                <i class="fas fa-info-circle text-green-600 text-xl mb-2"></i>
                                <p class="text-green-800 font-medium">Esta mascota fue encontrada por ti</p>
                                <p class="text-green-600 text-sm mt-1">Gracias por ayudar</p>
                                
                                <!-- Botón para ver conversaciones sobre esta mascota -->
                                <a href="{{ route('contactar.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors mt-3 text-sm">
                                    <i class="fas fa-comments mr-2"></i>
                                    Ver ofertas de ayuda
                                </a>
                            </div>
                        @else
                            <!-- Botón visible para todos los usuarios -->
                            @auth
                                <!-- Usuario logueado (no dueño) va al formulario de mensajería -->
                                <a href="{{ route('contactar.create', $mascota) }}" 
                                   class="w-full bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center text-lg">
                                    <i class="fas fa-heart mr-3 text-xl"></i>
                                    Ofrecer Hogar Temporal
                                </a>
                                
                                <p class="text-sm text-gray-600 mt-3">
                                    Iniciarás una conversación con quien encontró la mascota
                                </p>
                            @else
                                <!-- Usuario no logueado -->
                                <a href="{{ route('login') }}" 
                                   class="w-full bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center text-lg">
                                    <i class="fas fa-heart mr-3 text-xl"></i>
                                    Ofrecer Hogar Temporal
                                </a>
                                
                                <p class="text-sm text-gray-600 mt-3">
                                    ¿Puedes ofrecer cuidado temporal?
                                </p>
                            @endauth
                            
                            <!-- Información adicional para no logueados -->
                            @guest
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-700 flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Serás redirigido al inicio de sesión primero
                                    </p>
                                </div>
                            @endguest
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.6);
    }
    .modal-content {
        backdrop-filter: blur(10px);
    }
</style>
@endsection

@section('scripts')
<script>
function copiarEnlace() {
    const input = document.getElementById('shareUrl');
    
    input.select();
    input.setSelectionRange(0, 99999);
    
    navigator.clipboard.writeText(input.value).then(() => {
        mostrarNotificacion('Enlace copiado al portapapeles');
    });
}

function mostrarNotificacion(mensaje) {
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-0 opacity-100 transition-all duration-300 z-50';
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>${mensaje}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(100%)';
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Inicializar si no existe el elemento
document.addEventListener('DOMContentLoaded', function() {
    if (!document.getElementById('shareUrl')) {
        const shareDiv = document.createElement('div');
        shareDiv.innerHTML = `
            <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly class="hidden">
        `;
        document.body.appendChild(shareDiv);
    }
});
</script>
@endsection