<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Mascotas - Mascotas Sacaba</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .brand-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-card {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen font-sans">

    <!-- Header -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-green-200">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 brand-gradient rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-paw text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Mis Mascotas</h1>
                        <p class="text-gray-600 text-sm">Gestiona tus mascotas registradas</p>
                    </div>
                </div>
                
                <a href="{{ route('user.dashboard') }}" 
                   class="flex items-center px-4 py-2 text-gray-600 hover:text-green-600 transition-colors border border-gray-300 rounded-lg hover:border-green-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <!-- Alertas -->
        @if(session('success'))
            <div class="glass-card rounded-2xl p-6 mb-6 border-l-4 border-green-500 floating-card">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">¡Éxito!</h3>
                        <p class="text-gray-600">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Header de la Lista -->
        <div class="glass-card rounded-2xl p-6 mb-6 floating-card">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-paw text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Tus Mascotas</h2>
                        <p class="text-gray-600">{{ $mascotas->count() }} mascotas registradas</p>
                    </div>
                </div>
                
                <a href="{{ route('user.mascotas.create') }}" 
                   class="flex items-center px-6 py-3 brand-gradient text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nueva Mascota
                </a>
            </div>
        </div>

        @if($mascotas->count() > 0)
            <!-- Grid de Mascotas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mascotas as $mascota)
                    <div class="glass-card rounded-2xl p-6 floating-card hover-lift border-l-4 
                        @if($mascota->estado == 'perdida') border-red-500
                        @elseif($mascota->estado == 'encontrada') border-blue-500
                        @else border-green-500 @endif">
                        
                        <!-- Header de la Tarjeta -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br 
                                    @if($mascota->estado == 'perdida') from-red-500 to-red-600
                                    @elseif($mascota->estado == 'encontrada') from-blue-500 to-blue-600
                                    @else from-green-500 to-green-600 @endif 
                                    rounded-xl flex items-center justify-center">
                                    <i class="fas 
                                        @if($mascota->estado == 'perdida') fa-search-location
                                        @elseif($mascota->estado == 'encontrada') fa-home
                                        @else fa-heart @endif 
                                        text-white text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $mascota->nombre }}</h3>
                                    <span class="status-badge 
                                        @if($mascota->estado == 'perdida') bg-red-100 text-red-800
                                        @elseif($mascota->estado == 'encontrada') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ ucfirst($mascota->estado) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Información de la Mascota -->
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-paw text-gray-400 mr-2 w-4"></i>
                                    Especie:
                                </span>
                                <span class="font-semibold text-gray-800">{{ $mascota->especie }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-dna text-gray-400 mr-2 w-4"></i>
                                    Raza:
                                </span>
                                <span class="font-semibold text-gray-800">{{ $mascota->raza ?? 'N/A' }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-birthday-cake text-gray-400 mr-2 w-4"></i>
                                    Edad:
                                </span>
                                <span class="font-semibold text-gray-800">{{ $mascota->edad ? $mascota->edad . ' años' : 'N/A' }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-venus-mars text-gray-400 mr-2 w-4"></i>
                                    Sexo:
                                </span>
                                <span class="font-semibold text-gray-800">{{ $mascota->sexo ?? 'N/A' }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-palette text-gray-400 mr-2 w-4"></i>
                                    Color:
                                </span>
                                <span class="font-semibold text-gray-800">{{ $mascota->color ?? 'N/A' }}</span>
                            </div>

                            @if($mascota->ubicacion)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-2 w-4"></i>
                                    Ubicación:
                                </span>
                                <span class="font-semibold text-gray-800 text-right">{{ Str::limit($mascota->ubicacion, 20) }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Acciones -->
                        <div class="flex space-x-2 pt-4 border-t border-gray-200">
                            <!-- Botón VER agregado -->
                            <a href="{{ route('user.mascotas.show', $mascota) }}" 
                               class="flex-1 flex items-center justify-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>
                                Ver
                            </a>
                            
                            <a href="{{ route('user.mascotas.edit', $mascota) }}" 
                               class="flex-1 flex items-center justify-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors text-sm font-medium">
                                <i class="fas fa-edit mr-2"></i>
                                Editar
                            </a>
                            
                            <form action="{{ route('user.mascotas.destroy', $mascota) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar a {{ $mascota->nombre }}?')"
                                        class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors text-sm font-medium">
                                    <i class="fas fa-trash mr-2"></i>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado Vacío -->
            <div class="glass-card rounded-2xl p-12 text-center floating-card">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-paw text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">No tienes mascotas registradas</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Comienza registrando tu primera mascota para poder gestionarla en la plataforma.
                </p>
                <a href="{{ route('user.mascotas.create') }}" 
                   class="inline-flex items-center px-8 py-3 brand-gradient text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Registrar Primera Mascota
                </a>
            </div>
        @endif

        <!-- Información Adicional -->
        @if($mascotas->count() > 0)
            <div class="glass-card rounded-2xl p-6 mt-8 floating-card">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                    <div class="p-4 bg-blue-50 rounded-xl">
                        <div class="text-2xl font-bold text-blue-600">{{ $mascotas->where('estado', 'perdida')->count() }}</div>
                        <div class="text-sm text-gray-600">Mascotas Perdidas</div>
                    </div>
                    <div class="p-4 bg-green-50 rounded-xl">
                        <div class="text-2xl font-bold text-green-600">{{ $mascotas->where('estado', 'encontrada')->count() }}</div>
                        <div class="text-sm text-gray-600">Mascotas Encontradas</div>
                    </div>
                    <div class="p-4 bg-purple-50 rounded-xl">
                        <div class="text-2xl font-bold text-purple-600">{{ $mascotas->where('estado', 'adopcion')->count() }}</div>
                        <div class="text-sm text-gray-600">En Adopción</div>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-white/50 backdrop-blur-sm border-t border-green-200 mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center">
            <p class="text-gray-600 text-sm">
                💚 Mascotas Sacaba - Cuidando de nuestros compañeros
            </p>
        </div>
    </footer>

    <script>
        // Efectos de hover mejorados
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.hover-lift');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                    this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
                });
            });

            // Confirmación mejorada para eliminar
            const deleteButtons = document.querySelectorAll('form button[type="submit"]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('¿Estás seguro de que quieres eliminar esta mascota? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

</body>
</html>