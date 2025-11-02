@extends('layouts.app')

@section('title', 'Mis Mensajes')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mis Mensajes</h1>
            <p class="text-gray-600">Mensajes sobre tus mascotas publicadas</p>
        </div>

        @if($mensajes->count() > 0)
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-envelope mr-3"></i>
                        Mensajes Recibidos ({{ $mensajes->count() }})
                    </h2>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($mensajes as $mensaje)
                        <div class="p-6 hover:bg-gray-50 transition-colors {{ !$mensaje->leido ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 text-lg mb-1">
                                        {{ $mensaje->mascota->nombre }}
                                        <span class="text-sm font-normal text-gray-500">
                                            - {{ $mensota->especie }}
                                        </span>
                                    </h3>
                                    
                                    <div class="flex items-center text-sm text-gray-600 mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $mensaje->tipo == 'reclamo' ? 'bg-red-100 text-red-800' : 
                                               ($mensaje->tipo == 'adopcion' ? 'bg-purple-100 text-purple-800' : 
                                               'bg-blue-100 text-blue-800') }}">
                                            @if($mensaje->tipo == 'reclamo')
                                                🏠 Reclamo
                                            @elseif($mensaje->tipo == 'adopcion')
                                                ❤️ Adopción
                                            @else
                                                🏡 Hogar Temporal
                                            @endif
                                        </span>
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-user mr-1"></i>
                                        {{ $mensaje->nombre }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $mensaje->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                
                                @if(!$mensaje->leido)
                                    <button onclick="marcarLeido({{ $mensaje->id }})" 
                                            class="ml-4 px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors">
                                        Marcar leído
                                    </button>
                                @else
                                    <span class="ml-4 px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium">
                                        <i class="fas fa-check mr-1"></i> Leído
                                    </span>
                                @endif
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                <p class="text-gray-700 whitespace-pre-line">{{ $mensaje->mensaje }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Información de contacto:</h4>
                                    <div class="space-y-1">
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-gray-400 mr-2 w-4"></i>
                                            <a href="mailto:{{ $mensaje->email }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $mensaje->email }}
                                            </a>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 mr-2 w-4"></i>
                                            <a href="tel:{{ $mensaje->telefono }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $mensaje->telefono }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Acciones:</h4>
                                    <div class="flex space-x-2">
                                        <a href="https://wa.me/{{ $mensaje->telefono }}?text=Hola {{ $mensaje->nombre }}, vi tu mensaje sobre {{ $mensaje->mascota->nombre }}"
                                           target="_blank"
                                           class="flex-1 bg-green-500 text-white px-3 py-2 rounded-lg text-center hover:bg-green-600 transition-colors text-sm">
                                            <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                                        </a>
                                        <a href="mailto:{{ $mensaje->email }}?subject=Respuesta sobre {{ $mensaje->mascota->nombre }}"
                                           class="flex-1 bg-blue-500 text-white px-3 py-2 rounded-lg text-center hover:bg-blue-600 transition-colors text-sm">
                                            <i class="fas fa-envelope mr-1"></i> Email
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope-open text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No tienes mensajes aún</h3>
                <p class="text-gray-600 mb-6">Cuando alguien se interese por tus mascotas, los mensajes aparecerán aquí.</p>
                <a href="{{ route('user.mascotas.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all font-medium">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Publicar Mascota
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function marcarLeido(contactoId) {
    fetch(`/mensajes/${contactoId}/leido`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
@endsection