@extends('layouts.app')

@section('title', 'Contactar Dueño - ' . $mascota->nombre)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            @php
                $rutaVolver = match($mascota->estado) {
                    'perdida' => route('mascotas.perdidas.show', $mascota->id),
                    'encontrada' => route('mascotas.encontradas.show', $mascota->id),
                    'adopcion' => route('mascotas.adopcion.show', $mascota->id),
                    default => route('inicio')
                };
                
                // Determinar el tipo de contacto según el estado de la mascota
                $tipoContacto = match($mascota->estado) {
                    'perdida' => 'reclamar',
                    'encontrada' => 'ofrecer hogar temporal',
                    'adopcion' => 'solicitar adopción',
                    default => 'contactar'
                };
                
                $tituloBoton = match($mascota->estado) {
                    'perdida' => 'Reclamar Mascota',
                    'encontrada' => 'Ofrecer Hogar Temporal',
                    'adopcion' => 'Solicitar Adopción',
                    default => 'Contactar'
                };

                // Mensaje predefinido - SEPARADO PARA EVITAR ERRORES
                $mensajePredefinido = "Hola " . $mascota->user->name . ",\n\n";
                $mensajePredefinido .= "Me interesa " . $tipoContacto . " a " . $mascota->nombre . ".\n\n";
                
                if($mascota->estado == 'perdida') {
                    $mensajePredefinido .= "Creo que es mi mascota perdida porque:\n\n• [Describe características únicas]\n• [Menciona detalles específicos]\n• [Proporciona información de identificación]\n\n";
                } elseif($mascota->estado == 'encontrada') {
                    $mensajePredefinido .= "Puedo ofrecerle hogar temporal porque:\n\n• [Describe tu experiencia con mascotas]\n• [Menciona el espacio disponible]\n• [Indica disponibilidad de tiempo]\n\n";
                } else {
                    $mensajePredefinido .= "Estoy interesado en adoptar porque:\n\n• [Describe tu experiencia previa]\n• [Menciona tu situación familiar]\n• [Explica por qué serías buen dueño]\n\n";
                }
                
                $mensajePredefinido .= "Mi información de contacto:\n- Teléfono: \n- Email: " . (Auth::check() ? Auth::user()->email : '') . "\n\n";
                $mensajePredefinido .= "¿Podemos coordinar para conversar?\n\nGracias";
            @endphp
            
            <a href="{{ $rutaVolver }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors mb-6">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a {{ $mascota->nombre }}
            </a>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Contactar al dueño de {{ $mascota->nombre }}
            </h1>
            <p class="text-lg text-gray-600">
                Elige cómo quieres contactar al dueño
            </p>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tarjeta de Opciones de Contacto -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-comments mr-3"></i>
                    Opciones de Contacto
                </h2>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- WhatsApp Directo -->
                    <div class="text-center">
                        <a href="https://wa.me/{{ $mascota->user->telefono ?? '59176967008' }}?text=Hola, me interesa {{ $tipoContacto }} a {{ $mascota->nombre }}. ¿Podemos hablar?"
                           target="_blank"
                           class="block p-6 bg-green-50 border-2 border-green-200 rounded-xl hover:bg-green-100 hover:border-green-300 transition-all duration-300 transform hover:scale-105 group">
                            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                                <i class="fab fa-whatsapp text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-green-800 text-lg mb-2">WhatsApp Directo</h3>
                            <p class="text-green-600 text-sm mb-3">Contacto inmediato</p>
                            <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                <i class="fas fa-bolt mr-1"></i> Más rápido
                            </span>
                        </a>
                        <p class="text-xs text-gray-500 mt-2">
                            Se abrirá WhatsApp en tu teléfono
                        </p>
                    </div>

                    <!-- Formulario de Contacto 
                    <div class="text-center">
                        <button type="button" onclick="mostrarFormulario()"
                                class="w-full p-6 bg-blue-50 border-2 border-blue-200 rounded-xl hover:bg-blue-100 hover:border-blue-300 transition-all duration-300 transform hover:scale-105 group">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <i class="fas fa-envelope text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-blue-800 text-lg mb-2">Formulario Seguro</h3>
                            <p class="text-blue-600 text-sm mb-3">Mensaje dentro de la plataforma</p>
                            <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                <i class="fas fa-shield-alt mr-1"></i> Más seguro
                            </span>
                        </button>
                        <p class="text-xs text-gray-500 mt-2">
                            Tu información está protegida
                        </p>
                    </div>-->
                </div>

                <!-- Información de contacto -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <h4 class="font-medium text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Información del dueño
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-user text-gray-400 mr-2 w-4"></i>
                            <span class="text-gray-600">{{ $mascota->user->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-gray-400 mr-2 w-4"></i>
                            <span class="text-gray-600">{{ $mascota->user->email }}</span>
                        </div>
                        @if($mascota->user->telefono)
                        <div class="flex items-center">
                            <i class="fas fa-phone text-gray-400 mr-2 w-4"></i>
                            <span class="text-gray-600">{{ $mascota->user->telefono }}</span>
                        </div>
                        @else
                        <div class="flex items-center">
                            <i class="fas fa-phone text-gray-400 mr-2 w-4"></i>
                            <span class="text-gray-600">No disponible</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Contacto (oculto inicialmente) -->
        <div id="formularioContacto" class="hidden bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center justify-between">
                    <span>
                        <i class="fas fa-edit mr-3"></i>
                        Formulario de Contacto
                    </span>
                    <button type="button" onclick="ocultarFormulario()" class="text-white hover:text-blue-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </h2>
            </div>

            <div class="p-6">
                <form action="{{ route('contactar.store') }}" method="POST" id="formContacto">
                    @csrf
                    <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Tu Nombre *
                            </label>
                            <input type="text" 
                                   id="nombre"
                                   name="nombre" 
                                   value="{{ Auth::check() ? Auth::user()->name : old('nombre') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Tu Email *
                            </label>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-6">
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                            Tu Teléfono *
                        </label>
                        <input type="tel" 
                               id="telefono"
                               name="telefono" 
                               value="{{ old('telefono', Auth::check() && Auth::user()->telefono ? Auth::user()->telefono : '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="+591 123 456 78"
                               required>
                        @error('telefono')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Para que el dueño pueda contactarte</p>
                    </div>

                    <!-- Mensaje -->
                    <div class="mb-6">
                        <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-2">
                            Tu Mensaje *
                        </label>
                        <textarea id="mensaje"
                                  name="mensaje" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors"
                                  placeholder="Explica por qué estás interesado en {{ $tipoContacto }} a {{ $mascota->nombre }}..."
                                  required>{{ old('mensaje', $mensajePredefinido) }}</textarea>
                        @error('mensaje')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">
                            Sé específico para generar confianza
                        </p>
                    </div>

                    <!-- Información importante -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-medium text-yellow-800 mb-2">Información importante</h4>
                                <ul class="text-sm text-yellow-700 space-y-1">
                                    <li>• Proporciona información verificable y honesta</li>
                                    <li>• Sé respetuoso en tu comunicación</li>
                                    <li>• Coordina encuentros en lugares públicos</li>
                                    <li>• Verifica la identidad antes de proceder</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="button" 
                                onclick="ocultarFormulario()"
                                class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </button>
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all transform hover:scale-105 font-medium">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ $tituloBoton }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información de la mascota -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Información de {{ $mascota->nombre }}
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">Especie</p>
                    <p class="font-medium">{{ $mascota->especie }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Raza</p>
                    <p class="font-medium">{{ $mascota->raza ?? 'No especificada' }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Color</p>
                    <p class="font-medium">{{ $mascota->color ?? 'No especificado' }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Ubicación</p>
                    <p class="font-medium">{{ $mascota->ubicacion ?? 'No especificada' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Funciones para mostrar/ocultar el formulario
function mostrarFormulario() {
    console.log('Mostrando formulario de contacto...');
    const formulario = document.getElementById('formularioContacto');
    if (formulario) {
        formulario.classList.remove('hidden');
        formulario.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}

function ocultarFormulario() {
    console.log('Ocultando formulario...');
    const formulario = document.getElementById('formularioContacto');
    if (formulario) {
        formulario.classList.add('hidden');
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('Página de contacto cargada correctamente');
    
    // Agregar event listeners adicionales para mayor seguridad
    const botonFormulario = document.querySelector('button[onclick*="mostrarFormulario"]');
    if (botonFormulario) {
        botonFormulario.addEventListener('click', mostrarFormulario);
    }
    
    const botonCancelar = document.querySelector('button[onclick*="ocultarFormulario"]');
    if (botonCancelar) {
        botonCancelar.addEventListener('click', ocultarFormulario);
    }

    // Prevenir envío múltiple del formulario
    const form = document.getElementById('formContacto');
    if (form) {
        form.addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Enviando...';
            }
        });
    }

    // Verificar si hay parámetros en la URL para mostrar el formulario directamente
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('form') === 'true') {
        mostrarFormulario();
    }
});
</script>
@endsection